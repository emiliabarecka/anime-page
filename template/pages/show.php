<?php
$anime = $params['anime'] ?? null;
?>
<?php if($anime): ?>
<div class="row">
    <div class="col">
        <a href="/animePage/"><button class="btn btn-secondary">Powót do strony głównej</button></a>
        <a href="/animePage/?action=edit&id=<?php echo $anime['id']?>"><button class="btn btn-secondary m-5">Edytuj</button></a>
        <a href="/animePage/?action=delete&id=<?php echo $anime['id']?>"><button class="btn btn-secondary">Usuń</button></a>
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
    <div class="col">
        <p>
        <?php echo ($anime['description_1']);?>
        <img src="img/Ciel.jpg" alt="img" class="img-fluid float-start m-3 " style="max-width:200px">
        </p>
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
