//var simplemde = new SimpleMDE();
const el = document.querySelector('textarea');
const stackedit = new Stackedit();


// Listen to StackEdit events and apply the changes to the textarea.
stackedit.on('fileChange', (file) => {
    el.value = file.content.text;
});

function makeEditButton(el) {
    const div = document.createElement('div');
    div.className = 'stackedit-button-wrapper';
    div.innerHTML = '<a href="javascript:void(0)"><img src="https://benweet.github.io/stackedit.js/icon.svg">Edit with StackEdit</a>';
    el.parentNode.insertBefore(div, el.nextSibling);
    return div.getElementsByTagName('a')[0];
}


const textareaEl = document.querySelector('textarea');
makeEditButton(textareaEl)
    .addEventListener('click', function onClick() {
        const stackedit = new Stackedit();
        stackedit.on('fileChange', function onFileChange(file) {
            textareaEl.value = file.content.text;
        });
        stackedit.openFile({
            name: 'Markdown with StackEdit',
            content: {
                text: textareaEl.value
            }
        });
    });
