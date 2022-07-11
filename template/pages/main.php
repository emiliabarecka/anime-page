    <div class="message my-2" style="color:green">
      <?php
      if(!empty($params['before'])){
        switch($params['before']){
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
    <div class="error my-2" style="color:red; font-weight:700px; font-size:20px ">
      <?php
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
    <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
    <h6>cos tam jak wspaniale jest anime, czemu warto ogąladać, czemu trzeba dobrze wybrac pierwszą, żeby nie odbić się od gatunku</h6>
    <?php foreach($params['animes'] ?? [] as $anime):?>
      <div class="row mt-5">  
          <div class="col-3">
            <img src="<?php echo $params['directory'] . '\\' . $anime['image_name'] ?>" alt="img" class="img-fluid">
          </div>
          <div class="col-9 px-5">
            <p hidden><?php echo $anime['id']?></p>
            <h3><?php echo ($anime['title']) ?></h3>
            <p><?php echo ($anime['description_0']) ?></p>
            <a href="/animePage/?action=show&id=<?php echo $anime['id']; ?>" role="button" class="btn btn-secondary">Więcej</a>    
        </div> 
      </div> 
    <?php endforeach;?>
    
  