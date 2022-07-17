
  
<form method="post" action="/animePage/?action=create" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label h3 mt-3 mb-3">Title<span class="required" style="color:white"> * </span></label>
    <input type="text" class="form-control" id="title" name="title" required>
  </div>
  <div class="mb-3 editor-wrapper">
    <label class="form-label h3">Description</label>
    <textarea class="form-control editor" name="desc"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Characters</label>
    <textarea class="form-control" name="characters"></textarea>
  </div>
  <div class="mb-3  editor-wrapper">
    <label class="form-label h3">Epizodes</label>
    <textarea class="form-control" name="eps"></textarea>
  </div>
  <div class="mb-3">
  <input class="form-control" type="file" name="img"/>
  </div>
  <button type="submit" class="btn btn-secondary mb-5 ">Submit</button>
</form>
<script src="src/Utils/CKE/build/ckeditor.js"></script>
<script>ClassicEditor
      .create( document.querySelector( '.editor' ), {
				} )
				.then( editor => {
					window.editor = editor;	
				} )
				.catch( error => {
					console.error( 'Oops, something went wrong!' );
					console.error( 'Please, report the following error on https://github.com/ckeditor/ckeditor5/issues with the build id and the error stack trace:' );
					console.warn( 'Build id: xfem63hfkrtv-cnm5wk2byxow' );
					console.error( error );
				} );
    
		</script>
  


