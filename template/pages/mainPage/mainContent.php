<?php $images = $params['images'];

// tu od razu zrobić sprawdzenie ownera
// if (!owner && published) : show ? ''

foreach ($params['animes'] ?? [] as $anime) : ?>
  <div class="row mt-5">
      <?php $random = rand(0, (count($images[$anime['id']])) - 1); ?>
      <div class="col-4">
        <img src="<?php echo $params['directory'] . '\\' . $images[$anime['id']][$random]; ?>" alt="img" class="img-fluid float-start">
      </div>
      <div class="col-8">
        <p hidden><?php echo $anime['id'] ?></p>
        <h3><?php echo ($anime['title']) ?></h3>
        <p><?php echo ($anime['description_0']) ?></p>
        <a href="/animePage/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>
    <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] === 'owner') : ?>
          <a href="/animePage/?action=edit&id=<?php echo $anime['id'] ?>"><button class="btn btn-secondary">Edytuj</button></a>
          <a href="/animePage/?action=delete&id=<?php echo $anime['id'] ?>"><button class="btn btn-danger">Usuń</button></a>
    <?php endif; ?>
      </div>
  </div>
<?php endforeach; ?>