    <div class="message my-2" style="color:green">
      <?php
      if(!empty($params['before'])): ?>  
      <?php 
      switch($params['before']){
        case 'created':
          echo 'Dodano anime do bazy';
        break;
      } 
       
      ?>
      <?php endif ?>
    </div>
    <h1 class="text-center mb-5 h2">Najlepsze anime na początek</h1>
    <h6>cos tam jak wspaniale jest anime, czemu warto goladac, czemu trzeba dobrze wybrac pierwszą, żeby nie odbić się od gatunku</h6>
    <?php foreach($params['animes'] ?? [] as $anime):?>
      <div class="row mt-5 obrazek">  
          <div class="col-3">
            <img src="<?php echo $params['directory'] . '\\' . $anime['image_name'] ?>" alt="img" class="img-fluid">
          </div>
          <div class="col-9 px-5">
            <h3><?php echo htmlentities($anime['title']) ?></h3>
            <p><?php echo htmlentities($anime['description_0']) ?></p>
            <form action="/animePage/?action=edit" method="post">
            
            <button class=" btn btn-outline-secondary" type="submit">Więcej</button>
            </form>
            
        </div> 
      </div> 
    <?php endforeach;?>
    
  