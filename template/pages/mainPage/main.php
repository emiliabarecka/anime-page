<div class="row">
    <div class="error my-2" style="color:red; font-weight:700px; font-size:20px ">
  <?php
  if (!empty($_GET['error'])) {
    switch ($_GET['error']) {
      case 'animeNotFound':
        echo 'Nie znaleziono anime o takim indeksie ';
        break;
      case 'missingId':
        echo 'Nieprawidłowy parametr';
        break;
    }
  }
  ?>
</div>
  <div class="col message" style="color:green">
    <?php
    if (!empty($_GET['before']) && $_GET['before'] === 'deleted') {
      echo ('Usunięto anime');
    }
    ?>
  </div>
</div>
<?php 
  include_once('headerContent.php');
  include_once('mainContent.php'); 
?>


