<?php

namespace frontend\controllers;

use common\components\UserPermissions;
use common\models\Article;
use common\models\ArticleAttachment;
use common\models\ArticleCategory;
use common\models\ArticleRevision;
use common\models\ArticleTag;
use common\models\Star;
use common\models\User;
use frontend\models\search\ArticleSearch;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends BaseController
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        // allow all to a access index and view action
                        'allow' => true,
                        'actions' => ['index', 'view', 'history', 'revision'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['create', 'list-tags', 'update', 'keep-alive'],
                        'roles' => ['@'],
                    ],
//                    [
//                        // allow all to a access index and view action
//                        'allow' => true,
//                        'actions' => ['admin', 'create', 'update', 'delete', 'list-tags'],
//                        'roles' => ['news:pAdmin'],
//                    ],
                ]
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }
    /**
     * @return string
     */
    public function actionIndex($category = null, $tag = null, $version = '2.0')
    {
        $query = Article::find()->with(['category']);
        $searchParam = getParam('title');
        if ($searchParam) {
            $query->andWhere(['like', 'title', $searchParam]);
        }

        $searchModel = new ArticleSearch();
        /*
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->sort = [
            'defaultOrder' => ['created_at' => SORT_DESC]
        ];*/
        $categoryModel = null;
        if ($category !== null) {
            $category = (int)$category;
            if (($categoryModel = ArticleCategory::findOne($category)) === null) {
                throw new NotFoundHttpException('The requested category does not exist.');
            }
            $query->andWhere(['category_id' => $category]);
        }

        $tagModel = null;
        if ($tag !== null) {
            $tagModel = ArticleTag::findOne(['slug' => $tag]);
            if ($tagModel === null) {
                throw new NotFoundHttpException('The requested tag does not exist.');
            }
            $query->joinWith('tags', false);
            $query->andWhere(['article_tag_id' => $tagModel->id]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 3,
            ],
            'sort' => [
                'defaultOrder' => ['created_at' => SORT_DESC],
            ],
        ]);

        if ($dataProvider->getCount() === 0) {
            Yii::$app->response->statusCode = 404;
        }
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'category' => $categoryModel,
            'tag' => $tagModel,
        ]);
    }

    /**
     * @param $slug
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionView($id, $revision = null)
    {
        $model = Article::find()
            //->published()
            ->andWhere(['id' => $id])->one();
        if (!$model) {
            throw new NotFoundHttpException('Article Not Found!');
        }

        // normalize slug URL
        $slug = Yii::$app->request->get('name');
        if ($model->slug !== (string)$slug) {
            return $this->redirect(['article/view', 'id' => $model->id, 'name' => $model->slug, 'revision' => $revision], 301);
        }
        // update view count
        if (Yii::$app->request->isGet) {
            $model->updateCounters(['view_count' => 1]);
        }
        $searchModel = new ArticleSearch();
        $viewFile = $model->view ?: 'view';
        return $this->render($viewFile, ['model' => $model, 'searchModel' => $searchModel,]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     * @throws \yii\web\HttpException
     */
    public function actionAttachmentDownload($id)
    {
        $model = ArticleAttachment::findOne($id);
        if (!$model) {
            throw new NotFoundHttpException;
        }

        return Yii::$app->response->sendStreamAsFile(
            Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
            $model->name
        );
    }

    public function actionCreate()
    {
        $model = new Article();
        $model->loadDefaultValues();
        //$model->scenario = 'create';

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {

            //Star::castStar($model, Yii::$app->user->id, 1);
            return $this->redirect(['view', 'id' => $model->id, 'slug' => $model->slug]);
        }

        return $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * @param $id
     * @param null $revision
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id, $revision = null)
    {
        /** @var Article $model */
        $model = $this->findModel($id, $revision);

        if (!UserPermissions::canUpdateArticlePage($model)) {
            Yii::$app->session->addFlash(
                'warning',
                'Sorry, you are too new to edit wiki articles. Please try posting in our forum first or add a <a href="#comments">comment</a> to the wiki article. ' . "<br>\n"
                . 'When you gain a rating of at least ' . UserPermissions::MIN_RATING_EDIT_WIKI . ' you can update wikis.'
            );
            return $this->redirect($model->getUrl());
        }

        //$model->scenario = 'update';

        if ($revision !== null) {
            $rev = $this->findRevision($id, $revision);
            $model->memo = 'Reverted to revision #' . $rev->revision;
        }

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            //Star::castStar($model, Yii::$app->user->id, 1);
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * actionList to return matched tags
     */
    public function actionListTags($query)
    {
        $models = ArticleTag::find()->where(['like', 'name', $query])->all();
        $items = [];

        foreach ($models as $model) {
            $items[] = ['name' => $model->name];
        }

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $items;
    }


    /**
     * Just reply with a 'pong' to the session keep alive call.
     * This method is only accessable for logged in users, so session will be opened.
     * @return string
     */
    public function actionKeepAlive()
    {
        return 'pong';
    }

    /**
     * Finds the Wiki model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Article the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id, $revision = null)
    {
        if (($model = Article::find()->where(['id' => $id])->one()) !== null) {

            /*Yii::debug(print_r($model->attributes, true));

            if ($revision === null) {
                return $model;
            }

            $revisionModel = $this->findRevision($model->id, $revision);
            Yii::debug(print_r($revisionModel->attributes, true));
            $model->loadRevision($revisionModel);
            Yii::debug(print_r($model->attributes, true)); */
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    private $_revisions = [];

    /**
     * @param $id
     * @param $revision
     * @return ArticleRevision
     * @throws NotFoundHttpException
     */
    protected function findRevision($id, $revision)
    {
        if (isset($this->_revisions[$id][$revision])) {
            return $this->_revisions[$id][$revision];
        }
        $model = ArticleRevision::findOne(['wiki_id' => $id, 'revision' => (int)$revision]);

        if ($model === null) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }

        $this->_revisions[$id][$revision] = $model;
        return $model;
    }
}
