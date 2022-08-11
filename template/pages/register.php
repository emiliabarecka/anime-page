<?php 
$lang = [
    'login'     => ['zaloguj', 'log in'],
    'register'  => ['zarejestruj się', 'sign in'],
    'name'      => ['imie', 'name'],
    'password'  => ['hasło', 'password'],
    'terms'     => ['zgadzam się na warunki usługi', 'i agree all statements in terms of service']         
];
$language = $params['lang'];

if($language === 'pol'){
    $selectedLang = 0;
}else{
    $selectedLang = 1;
}
?>
    <div class="row d-flex text-align-center">
        <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'normal_user'):?>
          <div class="col my-5">
          <p class="h2 text-center">Pomyślna rejestracja, witaj na pokładzie !</p>
          <p class="h5 text-center">Mozesz teraz dodawać komentarze. Podziel się z nami swoimi ulubionymi anime.</p>
          </div>
          <?php include_once('coments.php');?>
          <?php else: ?> 
    </div>
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">
                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4"><?php echo $lang['register'][$selectedLang]; ?></p>
                <form class="mx-1 mx-md-4" method="POST">
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="name" />
                      <label class="form-label" for="form3Example1c"><?php echo $lang['name'][$selectedLang]; ?></label>
                    </div>
                  </div>
                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="email" />
                      <label class="form-label" for="form3Example3c">Email</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="userPassword" />
                      <label class="form-label" for="form3Example4c"><?php echo $lang['password'][$selectedLang]; ?></label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="passwordRepeat"/>
                      <label class="form-label" for="form3Example4cd"><?php echo $lang['password'][$selectedLang]?></label>
                    </div>
                  </div>

                  <div class="form-check d-flex justify-content-center mb-5">
                    <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3c" />
                    <label class="form-check-label" for="form2Example3">
                    <?php echo $lang['terms'][$selectedLang]?> <a href="#!">gggg</a>
                    </label>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-lg"><?php echo $lang['register'][$selectedLang]; ?></button>
                  </div>
                </form>
                </div>
                <div class="d-flex justify-content-center">
                    <div><a class="btn btn-primary" href="/animePage/?action=register&lang=pol">POLSKI</a></div>
                    <div class="btn btn-info ms-3"><a href="/animePage/?action=register&lang=eng">ENGLISH</a></div>
                </div>     
            </div>
          </div>
        </div>
      </div>
      <?php endif; ?>
    </div>
  
