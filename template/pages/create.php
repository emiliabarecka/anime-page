<?php
$anime = $params['anime'] ?? null;
$images = $params['img'] ?? null;
dump($anime['published']);
?>
<div class="row">
  <div class="col">
    <a href="/animePage/"><button class="btn btn-secondary m-3">Powrót</button></a>
  </div>
</div>
<form method="post" action="/animePage/?action=<?php echo ($anime) ? 'edit' : 'create'?>" enctype="multipart/form-data">
<input type="hidden" name='id' value=<?php echo ($anime) ? $anime['id']: null; ?>>  
<div class="mb-3">
    <label for="title" class="form-label h3 mt-3 mb-3">Tytuł<span class="required" style="color:white"> * </span></label>
    <input type="text" class="form-control" id="title" name="title" required value="<?php echo ($anime) ? $anime['title'] : null?>">
  </div>
  <div class="mb-3 editor-wrapper">
    <label class="form-label h3">Description</label>
    <textarea class="form-control editor" name="desc"><?php echo ($anime) ? $anime['description_0'] : null?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Characters</label>
    <textarea class="form-control" name="characters"><?php echo ($anime) ? $anime['charactersString'] : null?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Episodes</label>
    <textarea class="form-control" name="eps"><?php echo ($anime) ? $anime['episodesString'] : null?></textarea>
  </div>
  <nav class="d-flex justify-content-around my-4 border">
    <button type="submit" class="btn btn-secondary m-2"><?php echo ($anime) ? 'Zapisz zmiany' : 'Dodaj'; ?></button>
    <label for="published" class="h5" style="color:greenyellow"> Opublikuj
  	  <input class="m-3" type="checkbox" id="published" name="published" value="<?php echo time(); ?>">
  	  <input class="m-3" type="hidden" name="ifPublished" value="<?php echo ($anime['published'])?>">
    </label>
  </nav> 
</form>
<form action="/animePage/?action=insertImage&id=<?php echo $anime['id'] ?>" method="POST" enctype="multipart/form-data">
  <label class="form-label h5 me-2 bold">Dodaj obraz</label>
    <input type="file" name="img" class="image-input"/>
    <input type="hidden" value="<?php echo($anime) ? $anime['id'] : null;?>">
  <label class="form-label h5">Tytuł obrazu</label>
    <input type="text" name="title" class="image-input" id="title"/>
<button type="submit" class="btn btn-secondary">Dodaj</button>
</form>
<div class="row my-5">
  <?php if(!empty($images)):?>
  <?php foreach($images as $img):?>
      <div class="col-6 border py-3 d-flex flex-column align-items-center justify-content-between">
      <form action="/animePage/?action=editImage&id=<?php echo $anime['id']?>" method="post" enctype="multipart/form-data">
        <img src="<?php echo $params['directory'] . '\\' . $img['name'] ?>" alt="alt" class="img-thumbnail" style="width:150px">
        <fieldset>
          <div class="my-3">
            <input type="file" name="img" class="image-input" class="w-75">
            <input type="text" value="<?php echo $img['name']; ?>">
            <input type="hidden" name="id" value="<?php echo($img) ? $img['id'] : null;?>" class="w-25">
          </div>
        </fieldset>
        <fieldset>
          <div>
            <button type="submit" class="btn btn-secondary mx-3">Zmień</button>
            </form>
            <form action="/animePage/?action=deleteImage&id=<?php echo $anime['id']?>" method="POST" class="my-3">
              <input type="hidden" name="animeId"value="<?php echo($anime) ? $anime['id'] : null;?>">
              <input type="hidden" name="imageId"value="<?php echo($img) ? $img['id'] : null;?>">
              <button type="submit" class="btn btn-danger mx-3">Usuń</button>
            </form> 
          </div>
        </fieldset>
      </div>
        <?php endforeach;?>
  <?php endif ?>      
      </div>
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
  


