<div class="error my-2" style="color:red; font-weight:700px; font-size:20px ">
  <?php
  $images = $params['images'];
  if (!empty($params['error'])) {
    switch ($params['error']) {
      case 'animeNotFound':
        echo 'Nie znaleziono anime o indeksie ' . $params['id'];
        break;
      case 'missingId':
        echo 'Nieprawidłowy parametr';
        break;
    }
  }
  ?>
</div>
<div class=" row message my-2" style="color:green">
  <div class="col">
    <?php
    if (!empty($params['before'])) {
      switch ($params['before']) {
        case 'created':
          echo 'Dodano anime do bazy';
          break;
        case 'edited':
          echo 'Zmodyfikowano anime';
          break;
        case 'deleted':
          echo  'Usunięto anime';
          break;
      }
    }
    ?>
  </div>
</div>
<div class="row">
  <div class="col my-3">
    <?php if ($_SESSION['user_type'] === 'owner') : ?>
      <a href="/animePage/?action=create"><button class="btn btn-secondary">Dodaj nową anime</button></a>
      <a href="/animePage/?action=logOut"><button class="btn btn-primary ms-5">Wyloguj się</button></a>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col">
    <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
    <h6>cos tam jak wspaniale jest anime, czemu warto ogąladać, czemu trzeba dobrze wybrac pierwszą, żeby nie odbić się od gatunku</h6>
  </div>
</div>

<!-- require_once  -->
<?php foreach ($params['animes'] ?? [] as $anime) : ?>
  <div class="row mt-5">
    <?php if (!empty($images[$anime['id']])) : ?>
      <?php $random = rand(0, (count($images[$anime['id']])) - 1); ?>
      <div class="col-4">
        <img src="<?php echo $params['directory'] . '\\' . $images[$anime['id']][$random]; ?>" alt="img" class="img-fluid float-start">
      </div>
    <?php endif ?>
    <div class="col-8">
      <p hidden><?php echo $anime['id'] ?></p>
      <h3><?php echo ($anime['title']) ?></h3>
      <p><?php echo ($anime['description_0']) ?></p>
      <?php if ($_SESSION['user_type'] === 'owner') : ?>
        <a href="/animePage/?action=edit&id=<?php echo $anime['id'] ?>"><button class="btn btn-secondary m-5">Edytuj</button></a>
        <a href="/animePage/?action=delete&id=<?php echo $anime['id'] ?>"><button class="btn btn-danger">Usuń</button></a>
      <?php endif; ?>
      <a href="/animePage/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>
    </div>
  </div>
<?php endforeach; ?>