<?php
$anime = $params['anime'] ?? null;
$user = $_SESSION['user_type'] ?? null;
$text = $params['animeText'];
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
        <a href="<?php echo ($user === 'owner') ? '/animePage/?action=admin' : '/animePage';
        ?> "><button class="btn btn-secondary m-5"><?=($user === 'owner') ? 'Powót' : 'Powrót do strony głównej';?></button></a>
        <h1 class="my-5"><?php echo $anime['title']?></h1>
    </div>
</div>
<div class="row">
    <div class="col">
        <h4><?php 
        echo (is_array($text)) ? $text[count($text)-1] : $text;
        ?></h4>
    </div>
</div>
    <div class="row mt-3">  
        <div class="col-6">
            <h3 class="text-start">Postacie:</h3>
            <ul>
            <?php
            for($i = 0; $i<count($anime['characters'] ?? []); $i++): ?>
                <li class="list-unstyled text-start"><?php echo ($anime['characters'][$i]); ?></li>
            <?php endfor;?>
            </ul>
        </div>
        <div class="col-6">
            <h3 class="text-start">Odcinki:</h3>
            <ul>
            <?php for($i = 0; $i < count($anime['episodes'] ?? []); $i++): ?>
                <li class="list-unstyled text-start"><?php echo ($anime['episodes'][$i]); ?></li>
            <?php endfor;?>
            </ul>
        </div>   
    </div>
<?php endif; ?>
