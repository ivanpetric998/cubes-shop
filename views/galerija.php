<div id="portfolio">
  <div class="container">
    <div class="section-title text-center center">
      <h2>Galerija</h2>
      <hr>
    </div>
    <div class="row">
      <div class="portfolio-items"  id="galerija">        
      </div>
    </div>
      <div id="paginacija3">
        <ul class="pagination" id="paginacija4">

        <?php
        $upit = "SELECT COUNT(*) AS brojSlika FROM artikal";
        $rezultat = $konekcija->query($upit)->fetch(); 
        $brojSlika = $rezultat->brojSlika;
        $brojLinkova = ceil($brojSlika / 4); 
        for($i=1; $i <= $brojLinkova; $i++):
          if($i==1):
          ?>
              <li class='active'>
                  <a href="#" class="pagGal" data-id="<?=$i;?>">
                    <?=$i;?>
                   </a>
              </li>
          <?php else:?>
          <li>
            <a href="#" class="pagGal" data-id="<?=$i;?>">
              <?=$i;?>
            </a>
          </li>
          <?php endif; endfor;?>
        </ul> 
    </div>
    
  </div>
</div>