<div class="row">
  <div class="col my-3">
    <?php if (!empty($_SESSION['user_type']) && $_SESSION['user_type'] === 'owner') : ?>
      <a href="/?action=create"><button class="btn btn-secondary">Dodaj nową anime</button></a>
    <?php endif; ?>
  </div>
</div>
<div class="row">
  <div class="col">
    <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
    <h6>cos tam jak wspaniale jest anime, czemu warto ogąladać, czemu trzeba dobrze wybrac pierwszą, żeby nie odbić się od gatunku</h6>
  </div>
</div>