<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv=="Korisnik"): 

      $idKorisnika=$_SESSION['korisnik']->idKorisnik;

      $upitKorisnik="SELECT ime,prezime,email FROM korisnik WHERE idKorisnik=:id";
      $slanjeUpitKorisnik=$konekcija->prepare($upitKorisnik);
      $slanjeUpitKorisnik->bindParam(":id",$idKorisnika);
      if($slanjeUpitKorisnik->execute()){
        if($slanjeUpitKorisnik->rowCount()==1){
          $kor=$slanjeUpitKorisnik->fetch();
        }
      }
?>
<div id="contact">
  <div class="container">
    <div class="section-title text-center">
      <h2>Kontakt</h2>
      <hr>
      <p>Ako imete bilo kakve nedoumice ili druga pitanja, kontaktirajte nas putem mail-a</p>
    </div>
    <div class="col-md-4">
      <h3>Informacije</h3>
      <div class="contact-item"> <span>Adresa</span>
        <p>Glavna bb, Zemun<br>
         </p>
      </div>
      <div class="contact-item"> <span>Email</span>
        <p>ivan&#46;petric&#46;21&#46;17&#64;ict&#46;edu&#46;rs</p>
      </div>
      <div class="contact-item"> <span>Telefon</span>
        <p> +381 061 1212-123</p>
      </div>
    </div>
    <div class="col-md-8">
      <h3>Pošaljite poruku</h3>
      <form name="sentMessage" id="contactForm" novalidate>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <input type="text" id="imePrezime" name='imePrezime' class="form-control" placeholder="Ime i prezime" value="<?= $kor->ime.' '.$kor->prezime;?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <input type="email" id="emailKorisnika" name='emailKorisnika' class="form-control" placeholder="Email" value="<?= $kor->email;?>">
              <p class="help-block text-danger"></p>
            </div>
          </div>
        </div>
        <div class="form-group">
          <textarea name="message" id="message" class="form-control" rows="4" placeholder="Poruka" ></textarea>
          <p class="help-block text-danger"></p>
        </div>
        <div id="success"></div>
        <button type="button" class="btn btn-success register" name='saljiPoruku' id="saljiPoruku">Pošalji</button>
      </form>
    </div>
  </div>
</div>

<?php endif;?>