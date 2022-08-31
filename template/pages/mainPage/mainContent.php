<?php $images = $params['images'] ?? null;
foreach ($params['animes'] ?? [] as $anime) : ?>
  <div class="row mt-5">
    <div class="col-12 main">
      <h3 class="pt-3"><?php echo ($anime['title']) ?></h3>
    </div>
    <?php if($images):?>  
    <?php $random = rand(0, (count($images[$anime['id']])) - 1); ?>
      <div class="col-sm-12 col-md-6 ps-lg-3 mx-auto main" >
        <img 
          src="<?php echo $params['directory'] . '\\' . $images[$anime['id']][$random]; ?>" 
          alt="zdjęcie z postaciami z anime" 
          class="img-fluid mt-3 mt-md-5 mb-3" 
        >
      </div>
    <?php endif?>
      <div class="col-sm-12 col-md-6 p-3 main">
        <p hidden><?php echo $anime['id'] ?></p>
        <p class="p-sm-3"><?php echo ($anime['description_0']) ?></p>
        <a href="/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>
    <?php if (!empty($_SESSION['userType']) && $_SESSION['userType'] === 'owner') : ?>
          <a href="/?action=edit&id=<?php echo $anime['id'] ?>"><button class="btn btn-secondary">Edytuj</button></a>
          <a href="/?action=delete&id=<?php echo $anime['id'] ?>"><button class="btn btn-danger">Usuń</button></a>
    <?php endif; ?>
      </div>
  </div>
<?php endforeach; ?>

