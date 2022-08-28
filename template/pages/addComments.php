<?php 
 
?>
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 col-lg-10 col-xl-10 mt-2">
        <div class="card">
          <div class="card-body p-2">
            <div class="d-flex flex-start w-100">
              <div class="w-100">
                <p class="h5 my-3">Witaj <?php echo $_SESSION['userName'] ?? null ?> :) Podziel sie z nami swoją opinią.</p>
                <form method="POST" action="/animePage/?action=addComment">
                  <div class="form-outline">
                    <?php if(isset($_SESSION['userType']) && isset($_SESSION['userId']) && isset($_SESSION['userName']) ):?>
                    <input type="hidden" value=<?php echo $_SESSION['userId']?> name="userId">
                    <input type="hidden" id = "userType" value=<?php echo (isset($_SESSION['userType'])) ? $_SESSION['userType'] : null ?> name="userType">
                    <input type="hidden" value=<?php echo $_SESSION['userName']?> name="name">
                    <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">
                      Dodaj komentarz
                    </button>
                    </div>
                    <?php endif?>
                    <input type="hidden" value=<?php echo time(); ?> name="date">
                    <input type="hidden" value=<?php echo $anime['id'] ?? null?> name="animeId"> 
                    <div class="alert alert-danger d-none">Tylko zalogowani użytkownicy mogą dodawać komentarze</div>
                    <textarea class="form-control comment" rows="4" name="content"></textarea>
                  </div>
                </form>
                <?php if(empty($_SESSION['userType'])):?>
                <form method="POST" action="/animePage/?action=logIn">
                    <input type="hidden" value="<?php echo $anime['id']?>" name="animeId">
                  <button type="submit" class="btn btn-success text-uppercase mt-2">Zaloguj się</button>
                </form>
                <?php endif ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
