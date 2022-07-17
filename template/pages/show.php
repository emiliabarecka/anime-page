<?php
$anime = $params['anime'] ?? null;
?>
<div class=" row message my-2" style="color:green">
    <div class="col">
    <?php
        if(!empty($_GET['before'])){
            switch($_GET['before']){
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
<?php if($anime): ?>
<div class="row">
    <div class="col">
        <a href="<?php echo ($_SESSION['user_type'] === 'owner') ? '/animePage/?action=admin' : '/animePage'
        ?> "><button class="btn btn-secondary m-5"><?=($_SESSION['user_type'] === 'owner') ? 'Powót' : 'Powrót do strony głównej'?></button></a>
    </div>
</div>
<div class="row">
    <div class="col">
        <h2><?php echo ($anime['title']); ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-4"><img src="img/moDao.webp" alt="img" class="img-fluid"></div>
    <div class="col-lg-8">
        <p><?php echo ($anime['description_0']);?></p>
    </div>
</div>    
<div class="row mt-3">  
    <div class="col-6">
        <h3 class="text-start">Postacie:</h3>
        <ul>
            <?php
             for($i = 0; $i<count($anime['characters'] ?? []); $i++): ?>
                <li class="list-unstyled text-start"><?php echo ($anime['characters'][$i]) ?></li>
            <?php endfor;?>
        </ul>
    </div>
    <div class="col-6">
        <h3 class="text-start">Odcinki:</h3>
        <ul>
            <?php for($i = 0; $i < count($anime['episodes'] ?? []); $i++): ?>
                <li class="list-unstyled text-start"><?php echo ($anime['episodes'][$i]) ?></li>
            <?php endfor;?>
        </ul>
    </div>   
</div>
<?php endif; ?>
