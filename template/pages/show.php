<?php
$anime = $params['anime'] ?? null;
$user = $_SESSION['user_type'] ?? null;
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
            }
        }
        ?>
    </div>     
</div>
<?php if($anime): ?>
<div class="row">
    <div class="col">
        <a href="<?php echo ($user === 'owner') ? '/animePage/?action=admin' : '/animePage';
        ?> "><button class="btn btn-secondary m-3"><?=($user === 'owner') ? 'Powót' : 'Powrót do strony głównej';?></button></a>
        <h1 class="my-2"><?php echo $anime['title']?></h1>
    </div>
</div>
<div class="row">
        <?php if(is_array($params['animeText'])):?>
            <?php foreach($params['animeText'] as $text):?>
                <div>
                    <p class="px-3"><?php echo $text; ?></p>
                </div>
            <?php endforeach; ?>
            <?php else: echo ('Brak opisu') ?>
        <?php endif;  ?>
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
