<?php
print_r($params);
?>
<form method="post" action="animePage/?create">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label h3 mt-3 mb-3">Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>
  <div class="mb-3">
    <label class="form-label h3">Description 1</label>
    <textarea class="form-control" name="desc"></textarea>
  </div>
  <div class="mb-3">
    <label for="desc" class="form-label h3">Description 2</label>
    <textarea class="form-control" name="desc2"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Characters</label>
    <textarea class="form-control" name="chracters"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Epizodes</label>
    <textarea class="form-control" name="ep"></textarea>
  </div>
  <div class="mb-3">
  <input class="form-control" type="file" name="uploadfile" value="" />
  </div>
  <button type="submit" class="btn btn-secondary mb-5 ">Submit</button>
</form>
<b><?php echo $params['resultCreate'] ?? ""; ?></b>
