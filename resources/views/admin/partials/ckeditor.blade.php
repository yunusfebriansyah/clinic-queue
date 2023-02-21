<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
    .create( document.querySelector( '#description' ), {
        toolbar: [ 'bold', 'italic', 'link', 'bulletedList', 'numberedList' ]
    } )
    .catch( error => {
        console.log( error );
    } );
</script>