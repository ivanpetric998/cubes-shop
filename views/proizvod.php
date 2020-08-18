<div id="about">
  <div class="container">
    <div class="section-title text-center center">

    <?php if(isset($_GET['i'])):
        $id=$_GET['i'];
        $upitProizvod="SELECT * FROM artikal WHERE idArtikal=:id";
        $izvrsenje=$konekcija->prepare($upitProizvod);
        $izvrsenje->bindParam(":id",$id);  

        if($izvrsenje->execute()):
          $artikal=$izvrsenje->fetch();

    ?>

      <h2><?=$artikal->naziv?></h2>
      <hr>
    </div>
    
    <div class="row">
      <div class="col-xs-12 col-md-6 text-center"> <img src="<?=$artikal->slika?>" class="img-responsive" alt="<?=$artikal->alt?>"> </div>
      <div class="col-xs-12 col-md-6">
        <div class="about-text">
            <h3><?=$artikal->naziv?></h3>
            <p>Cena : <?=$artikal->cena?>,00 din.</p>
            <h3>Opis :</h3>
            <p><?=$artikal->opis?>
            </p>
            <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv=="Korisnik"): ?>
            <button type="button" data-id="<?=$artikal->idArtikal?>" class="brn btn-success register dodajUKorpu">Dodaj u korpu <i class="fa fa-shopping-cart"></i></button>
        <?php elseif(!isset($_SESSION['korisnik'])):echo("<p>Ako zelite da kupite morate da se prijavite</p>"); endif;?>
          </div>
      </div>
    </div>

        <?php else:
      echo "Greska sa serverom. Pokusajte kasnije";
    
      endif;
    endif;
    
    ?>



  </div>
</div>

