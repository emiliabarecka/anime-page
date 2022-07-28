<div class="error my-2" style="color:red; font-weight:700px; font-size:20px ">
      <?php
      $images = $params['images'];
      if(!empty($params['error'])){
        switch($params['error']){
          case 'animeNotFound':
            echo 'Nie znaleziono anime o indeksie '.$params['id'];
          break;
          case 'missingId':
            echo 'Nieprawidłowy parametr';
          break;  
        }
      }
      ?>
</div>
    <div class="row">
      <div class="col">
        <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
        <h6>cos tam jak wspaniale jest anime, czemu warto ogąladać, czemu trzeba dobrze wybrac pierwszą, żeby nie odbić się od gatunku</h6>
      </div>
    </div>           
    <?php foreach($params['animes'] ?? [] as $anime):?>
      <?php $random = rand(0, (count($images[$anime['id']]))-1)?>
      <div class="row mt-5">
        <div class="col-4">
          <img src="<?php echo $params['directory'] . '\\' .$images[$anime['id']][$random]; ?>" alt="img" class="img-fluid float-start">
        </div>
        <div class="col-8">
            <p hidden><?php echo $anime['id']?></p>
            <h3><?php echo ($anime['title']) ?></h3>
            <p><?php echo ($anime['description_0']) ?></p>
            <a href="/animePage/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>    
        </div> 
      </div>
       
    <?php endforeach;?>
    
  