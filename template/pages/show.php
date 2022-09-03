<?php
$anime = $params['anime'] ?? null;
$user = $_SESSION['userType'] ?? null;
?>
<div class="row error text-uppercase p-3" style="color:yellow">
    <div class="col">
        <?php
        if (!empty($_GET['error'])) {
            switch ($_GET['error']) {
                case 'insertImage':
                    echo 'Nie udało sie dodać obrazu';
                    break;
                case 'editImage':
                    echo 'Nie udało sie edytować obrazu';
                    break;
            }
        }
        ?>
    </div>
</div>
<div class=" row message my-2" style="color:green">
    <div class="col">
        <?php
        if (!empty($_GET['before'])) {
            switch ($_GET['before']) {
                case 'created':
                    echo 'Dodano anime do bazy';
                    break;
                case 'edited':
                    echo 'Zmodyfikowano anime';
                    break;
                case 'commented':
                    echo 'Dziekujemy za dodanie komentarza';
                    break;
                case 'picture':
                    echo 'wybierz obrazek';
                    break;
            }
        }
        ?>
    </div>
</div>
<?php if ($anime) : ?>
    <div class="row main">
        <div class="col">
            <h1 class="my-2 pt-2"><?php echo $anime['title'] ?></h1>
        </div>
    </div>
    <div class="row d-flex justify-content-center main pt-3">
        <?php if (is_array($params['animeText'])) : ?>
            <?php foreach ($params['animeText'] as $text) : ?>
                <div class="col show">
                    <p class="d-inline"><?php echo $text; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else : echo ('Brak opisu') ?>
        <?php endif ?>
    </div>
    <div class="row mt-3 main">
        <div class="col-md-6 d-md-block d-flex justify-content-sm-start">
            <h3>Postacie:</h3>
            <ul class="px-sm-1">
                <?php
                for ($i = 0; $i < count($anime['characters'] ?? []); $i++) : ?>
                    <li class="list-unstyled text-start"><?php echo ($anime['characters'][$i]); ?></li>
                <?php endfor ?>
            </ul>
        </div>
        <div class="col-md-6 d-md-block d-flex justify-content-sm-start">
            <h3>Odcinki:</h3>
            <ul class="px-sm-1">
                <?php for ($i = 0; $i < count($anime['episodes'] ?? []); $i++) : ?>
                    <li class="list-unstyled text-start"><?php echo ($anime['episodes'][$i]); ?></li>
                <?php endfor ?>
            </ul>
        </div>
    </div>
<?php endif; ?>
<?php include_once('addComments.php'); ?>
<?php include_once('comments.php'); ?>