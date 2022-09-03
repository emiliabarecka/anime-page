    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10 mt-5">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block">
              <img src="uploaded/welcome.jpg" alt="login form" class="img-fluid mt-5 mx-1" style="border-radius: 10px;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body">
                <form method="POST">
                  <div class="d-flex align-items-center mb-3 pb-1 mt-3">
                    <span class="h4 fw-bold mb-0"><img src="img/logo_transparent.png" width="40" alt="logo" class="d-inline-block ms-5 me-3" />Best-anime.pl</span>
                  </div>
                  <div class="form-outline mb-4">
                    <?php if (isset($_POST['animeId'])) : ?>
                      <input type="hidden" value="<?php echo $_POST['animeId'] ?>" name="animeId">
                    <?php endif ?>
                    <input type="text" id="form2Example17" class="form-control form-control-lg" name="name" />
                    <label class="form-label" for="form2Example17">login</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" id="form2Example27" class="form-control form-control-lg" name="password" />
                    <label class="form-label" for="form2Example27">hasło</label>
                  </div>
                  <div class="pt-1 mb-4">
                    <button class="btn btn-success btn-lg btn-block" type="submit">zaloguj</button>
                  </div>
                  <p class="mb-5 pb-lg-2">Zaloguj się, żeby dodawać komentarze. Nie masz konta? <a href="/?action=register" style="color: rgb(183, 188, 191); font-weight:bold">Zarejestruj się tutaj</a></p>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>