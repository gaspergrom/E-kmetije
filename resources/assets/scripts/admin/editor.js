export default () => {
    if($('#tinymceeditor').length){
        tinymce.init({
            selector: '#tinymceeditor',
            plugins: 'autolink lists link charmap print preview hr anchor',
            menubar: '',
            toolbar: 'undo redo | formatselect | bold italic underline strikethrough | alignleft aligncenter alignjustify | numlist bullist | link',
            toolbar_mode: 'floating',
        });
    }
}
