<?php
$anime = $params['anime'];
?>
<form method="post" action="/animePage/?action=edit" enctype="multipart/form-data">
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
    <textarea class="form-control" name="desc2"><?php echo $anime['description_1']?></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Characters</label>
    <textarea class="form-control" name="characters">
      <?php foreach($anime['characters'] as $character){
        echo $character.' ';
      }?>
    </textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Episodes</label>
    <textarea class="form-control" name="eps">
     </textarea>
  </div>
  <div class="mb-3">
  <input class="form-control" type="file" name="img"/>
  </div>
  <button type="submit" class="btn btn-secondary mb-5 ">Edytuj</button>
</form>