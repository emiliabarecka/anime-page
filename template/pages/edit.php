<?php
$anime = $params['anime'];
?>
<div class="row">
    <div class="col">
        <a href="/animePage/"><button class="btn btn-secondary">Powót do strony głównej</button></a>
    </div>
</div>
<?php if(!empty($anime)):?>
<form method="post" action="/animePage/?action=edit" enctype="multipart/form-data">
  <input type="hidden" name='id' value=<?php echo $anime['id'];?>>
  <div class="mb-3">
    <label for="title" class="form-label h3 mt-3 mb-3">Title</label>
    <input type="text" name="title" value="<?php echo $anime['title']?>">
  </div>
  <div class="mb-3">
    <label class="form-label h3">Description 1</label>
    <textarea class="form-control" name="desc"><?php echo $anime['description_0']?></textarea>
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label h3">Description 2</label>
    <textarea class="form-control" name="desc1"><?php echo $anime['description_1']?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Characters</label>
    <textarea class="form-control" name="characters">
   <?php echo $anime['charactersString'];?> 
    </textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Episodes</label>
    <textarea class="form-control" name="eps">
  <?php echo $anime['episodesString'];?>
     </textarea>
  </div>
  <div class="mb-3">
    <input type="hidden" name="pre-image" value="<?php echo $anime['image_name']?>">
  <input type="file" name="img" class="image-input"/>
  </div>
  <button type="submit" class="btn btn-secondary mb-5 ">Zapisz zmiany</button>
</form>
<?php else: ?>
  <div class="row">
    <div class="col"><h6>Brak danych do wyświetlenia</h6></div>
  </div>
 <?php endif; ?> 