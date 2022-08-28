<div class="row d-flex justify-content-center">
      <div class="col-md-10 col-lg-10 col-xl-10 mt-5">
        <div class="card">
            <form class="settings-form" method="POST" action="/?action=show&id=<?php echo $anime['id']?>">
                <table>
                    <thead>
                        <p class="h6 py-2 border border-dark mb-0 text-center">Komentarze</p>
                    <div class="border border-secondary">
                        <div>
                            <label>Sortuj od : Najstarszych </label><input  type="checkbox" class="m-1" name="sortBy" value="oldest">
                            <label>Najnowszych </label><input type="checkbox" class="m-1" name="sortBy" value="newest">
                        </div>
                       
                        <div>
                            <label>Ilość komentarzy : 1</label><input class="m-1" type="checkbox" value='1' name="pageSize">
                            <label>5</label><input class="m-1" type="checkbox" value='5' name="pageSize">
                            <label>10</label><input class="m-1" type="checkbox" value='10' name="pageSize">
                        <div>
                            <label>Numer strony</label><input type="text" value='1' name='pageNumber'>
                        </div>
                        <button type="submit" class="btn btn-success btn-sm m-1">Wyślij</button>
                        </div>
                    </div>
                    <div><span>nowa gałąź</span></div>
                    </thead>
                    <tbody>
                        <tr><?php if(!empty($params['comments'])):?>
                                <?php foreach($params['comments'] as $comment):?>
                            <div class="row pb-3 m-0 border border-dark">
                                <div class="col-2">
                                    <?php echo date('m/d/Y', $comment['date'])?>
                                </div>
                                <div class="col-2">
                                    <?php if(isset($_SESSION['userType']) && $_SESSION['userType'] === 'owner'):?>
                                    <input type="text" value=<?php echo $comment['user_id']?>>
                                    <?php endif ?>
                                    <?php echo $comment['user_name']. ' :'?>
                                </div> 
                                <div class="col-8">
                                <?php echo $comment['content']?>
                                </div>    
                            </div>
                            <?php endforeach ?>
                            <?php else :?>
                                <td class="ps-3">Brak komentarzy</td>
                            <?php endif ?>    
                        </tr>
                    </tbody>
                </table>
                
            </form>
        </div>
    </div>
</div>
