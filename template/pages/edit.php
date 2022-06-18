
<form method="post" action="/animePage/?action=edit" enctype="multipart/form-data">
  <div class="mb-3">
    <label for="title" class="form-label h3 mt-3 mb-3">Title<span class="required" style="color:white"> * </span></label>
    <input type="text" class="form-control" id="title" name="title" >
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
    <textarea class="form-control" name="characters"></textarea>
  </div>
  <div class="mb-3">
    <label class="form-label h3">Epizodes</label>
    <textarea class="form-control" name="eps"></textarea>
  </div>
  <div class="mb-3">
  <input class="form-control" type="file" name="img"/>
  </div>
  <button type="submit" class="btn btn-secondary mb-5 ">Submit</button>
</form>