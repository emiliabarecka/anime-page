<?php
$animes = $params['animes'] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="main.css">
    <link href="https://fonts.googleapis.com/css2?family=Courgette&family=Nunito+Sans:wght@400;700;800;900&family=Ubuntu:ital,wght@0,300;0,400;0,700;1,400;1,700&display=swap" rel="stylesheet">
</head>
<body>
<div class="container">
    <header>
        <nav class="navbar navbar-dark navbar-expand-lg ">
            <a href="/animePage" class="navbar-brand "><img src= "img/logo_transparent.png" width="40" alt="logo" class="d-inline-block ms-5 me-3"><span class="ps-3 fw-bold">Best-anime.pl</span></a>
            <button class="navbar-toggler me-2" type="button" data-toggle = "collapse" data-target = "#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="mainMenu">
                <ul class="navbar-nav ms-5 w-100">
                    <li class="nav-item">
                    <?php if($animes):?>
                        <a href="/animePage" class="nav-link dropdown-toggle h5 ms-5" data-toggle="dropdown" role="button" >Anime</a>
                    <?php endif ?>
                        <div class="w-75 dropdown-menu animeMenu p-2">
                            <?php foreach($animes as $anime):?>
                                <a href="/animePage/?action=show&id=<?php echo $anime['id']?>" class="menu-link text-decoration-none py-4"><?php echo $anime['title']?></a> 
                            <?php endforeach ?>    
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link dropdown-toggle h5 ms-5" data-toggle="dropdown" role="button">Postacie</a>
                        <div class="dropdown-menu animeMenu p2">
                            <p style="color: rgb(183, 188, 191)">Pracujemy nad tym :)</p>
                        </div>
                    </li>                    
                    <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] != null): ?>
                        <li class="nav-item ms-auto">
                            <a href="/animePage/?action=logOut"  class="nav-link h5 ms-5"  role="button">Wyloguj się<h5><?php echo $_SESSION['userName'] ?></h5></a>
                        </li>
                        <li class="nav-item ms-auto">
                            <a href="/animePage/?action=logOut"  class="nav-link h5 ms-5"  role="button">Dodaj komentarz<h5></h5></a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                        <a href="/animePage/?action=logIn"  class="nav-link  h5 ms-5"  role="button">Zaloguj się</a>    
                    </li>
                    <li class="nav-item">
                        <a href="/animePage/?action=register&lang=pol"  class="nav-link  h5 ms-5"  role="button">Zarejestruj się</a>
                    </li>
                    <?php endif ?>  
                </ul>
            </div>
        </nav>
    </header>
    <div class="row">
        <div class="d-none d-lg-block col-lg-2" > <img src="img/Wei.jpg" alt="zdjecie" class="img-fluid mt-5"></div>    
        <div class="col-sm-12 col-lg-8">
        <?php 
        include("template/pages/$page.php");
        ?>
        </div>
        <div class="d-none d-lg-block col-lg-2" ><img src="img/Wangji.jpg" alt="zdjecie" class="img-fluid mt-5"></div>   
    </div>
    <div class="row">
        <div class="col text-center pt-5">STOPKA</div>
    </div>
    </div>   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
</body>
</html>