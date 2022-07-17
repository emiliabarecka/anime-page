<div class="row admin">jestes w adminie</div>
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
    <div class=" row message my-2" style="color:green">
    <div class="col">
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
</div>
    <div class="row">
      <div class="col">
      <a href="/animePage/"><button class="btn btn-secondary">Powót do strony głównej</button></a>  
      <a href="/animePage/?action=create"><button class="btn btn-secondary">Dodaj nową anime</button></a>
      <a href="/animePage/?action=logOut"><button class="btn btn-danger ms-5">Wyloguj się</button></a>
      </div>
    </div>
    <?php foreach($params['animes'] ?? [] as $anime):?>
      <div class="row mt-5">  
          <div class="col-3">
            <img src="<?php echo $params['directory'] . '\\' . $anime['image_name'] ?>" alt="img" class="img-fluid">
          </div>
          <div class="col-9 px-5">
            <p hidden><?php echo $anime['id']?></p>
            <h3><?php echo ($anime['title']) ?></h3>
            <p><?php echo ($anime['description_0']) ?></p>
            <a href="/animePage/?action=edit&id=<?php echo $anime['id']?>"><button class="btn btn-secondary m-5">Edytuj</button></a>
            <a href="/animePage/?action=delete&id=<?php echo $anime['id']?>"><button class="btn btn-secondary">Usuń</button></a>    
        </div> 
      </div> 
    <?php endforeach;?>