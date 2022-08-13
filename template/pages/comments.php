<?php 
$date = new DateTime(); 
$date->setTimestamp(time());  
$commentDate = $date->format('d-m-Y'); 
?>
    <div class="row d-flex justify-content-center">
      <div class="col-md-10 col-lg-10 col-xl-10 mt-5">
        <div class="card">
          <div class="card-body p-4">
            <div class="d-flex flex-start w-100">
              <div class="w-100">
                <p class="h5 my-3">Witaj <?php echo $_SESSION['userName'] ?? null ?> :) Podziel sie z nami swoją opinią.</p>
                <form method="POST">
                  <div class="form-outline">
                    <input type="hidden" value=<?php echo $_SESSION['userId']?> name="userId">
                    <input type="hidden" value=<?php echo $_SESSION['userName']?> name="name">
                    <input type="hidden" value=<?php echo "$commentDate"?> name="date">
                    <textarea class="form-control" rows="4" name="content"></textarea>
                  </div>
                  <div class="d-flex justify-content-between mt-3">
                    <button type="submit" class="btn btn-success">
                      Dodaj komentarz
                    </button>
                </div>
                </form> 
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
