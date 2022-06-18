<?php

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
</head>
<body>
    <header>
        <nav class="navbar navbar-dark navbar-expand-md ">
            <a href="/animePage" class="navbar-brand "><img src= "img/logo_transparent.png" width="40" alt="logo" class="d-inline-block ms-3 me-2"><span class="ps-3">Best-anime.pl</span></a>
            <button class="navbar-toggler me-2" type="button" data-toggle = "collapse" data-target = "#mainMenu">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse ms-5" id="mainMenu">
                <ul class="navbar-nav ms-5">
                    <li class="nav-item">
                        <a href="/animePage" class="nav-link dropdown-toggle align-center h5 ms-5" data-toggle="dropdown" role="button" >Anime</a>
                        <div class="dropdown-menu animeMenu">
                            <a href="/animePage/?action=show"class="menu-link">Black</a>
                            <a href="/animePage/?action=show" class="menu-link">Grandmaster of demonic cultivation</a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link dropdown-toggle h5 align-center ms-5" data-toggle="dropdown" role="button">Postacie</a>
                    </li>                    
                    <li class="nav-item">
                        <a href="/animePage/?action=log" class="nav-link h5 align-center ms-5"  role="button">Zaloguj</a>
                    </li>
                    
                </ul>
            </div>
        </nav>
    </header>
    <div class="container-fluid pt-5">
    <div class="row">
        <div class="d-none d-lg-block col-lg-2" > <img src="img/Wei.jpg" alt="zdjecie" class="img-fluid d-inline"></div>
        <div class="col-sm-12 col-lg-8 pb-5">
        <?php 
        //page jest widoczna bo layout includujemy w View
        require_once("template/pages/$page.php");
        ?>
        </div>
        <div class="d-none d-lg-block col-lg-2" ><img src="img/Wangji.jpg" alt="zdjecie" class="img-fluid d-inline"></div>
    </div>
    <div class="row">
        <div class="col text-center pt-5">STOPKA</div>
    </div>
    </div>   
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
    <script src="main.js"></script>
</body>
</html>