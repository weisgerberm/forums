ClassicEditor
  .create( document.querySelector( '.forums-rte' ),{
    toolbar: {
      items: [
        'heading', '|',
        'bold', 'italic', 'strikethrough', 'underline','|',
        'bulletedList', 'numberedList', '|',
        'outdent', 'indent', '|',
        'undo', 'redo',
        '-',
        'fontSize', 'fontColor', 'fontBackgroundColor', 'highlight', '|',
        'alignment', '|',
        'link', 'blockQuote', 'insertTable', '|', 'horizontalLine', '|',
        'sourceEditing'
      ],
      shouldNotGroupWhenFull: true
    },
    placeholder: 'Welcome to CKEditor 5!'
  }).then( editor => {
  const wordCountPlugin = editor.plugins.get( 'WordCount' );
  const wordCountWrapper = editor.sourceElement.parentElement.nextElementSibling;


  wordCountWrapper.appendChild( wordCountPlugin.wordCountContainer );
} );
