<?php $images = $params['images'];
foreach ($params['animes'] ?? [] as $anime) : ?>
  <div class="row mt-5 gx-5">
    <div class="col-12">
    <h3><?php echo ($anime['title']) ?></h3>
    </div>
      <?php $random = rand(0, (count($images[$anime['id']])) - 1); ?>
      <div class="col col-sm-12 col-md-6">
        <img src="<?php echo $params['directory'] . '\\' . $images[$anime['id']][$random]; ?>" alt="img" class="img-fluid float-start  w-100 mx-3">
      </div>
      <div class="col col-sm-12 col-md-6 px-3">
        <p hidden><?php echo $anime['id'] ?></p>
        <p><?php echo ($anime['description_0']) ?></p>
        <a href="/animePage/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>
    <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] === 'owner') : ?>
          <a href="/animePage/?action=edit&id=<?php echo $anime['id'] ?>"><button class="btn btn-secondary">Edytuj</button></a>
          <a href="/animePage/?action=delete&id=<?php echo $anime['id'] ?>"><button class="btn btn-danger">Usuń</button></a>
    <?php endif; ?>
      </div>
  </div>
<?php endforeach; ?>