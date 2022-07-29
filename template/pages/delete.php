<?php
$anime = $params['anime'] ?? null;
?>
<?php if($anime): ?>

<div class="row">
    <div class="col">
        <a href="/animePage/"><button class="btn btn-secondary">Powót do strony głównej</button></a>
    <form method="POST" action="/animePage/">
        <input type="hidden" name='id' value="<?php echo $anime['id']?>">
        <button class= "btn btn-danger m-5" type="submit" >Usuń</button>
    </form>
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
<?php endif; ?>