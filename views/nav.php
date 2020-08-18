<nav id="menu" class="navbar navbar-default navbar-fixed-top on">
  <div class="container"> 
    
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"> 
	  <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> 
	  </button>
      <a class="navbar-brand page-scroll" href="index.php"><strong>Rubik's cube</strong></a> 
	  </div>
    
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
      <?php $svi=izvrsiUpit("SELECT * FROM gornjimeni WHERE flag=1"); foreach($svi as $svi1): #flag=1; Linkovi koje vide svi korisnini?>

      <li><a href="index.php?page=<?=$svi1->meniLink?>" ><?=$svi1->meniTekst?></a></li>
      
      <?php endforeach;?>

      <?php $odjavljeni=izvrsiUpit("SELECT * FROM gornjimeni WHERE flag=2"); #flag=2; Linkovi koje vide svi korisnini koji nisu prijavljeni
      
      if(!isset($_SESSION['korisnik'])):
      
      foreach($odjavljeni as $odj):?>

      <li><a href="index.php?page=<?=$odj->meniLink?>" ><?=$odj->meniTekst?></a></li>
      
      <?php endforeach; endif;?>

      <?php $autorizovani=izvrsiUpit("SELECT * FROM gornjimeni WHERE flag=4"); #flag=4; Linkovi koje vide svi autorizovani korisnini koji nisu admin

      if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv==="Korisnik"):
      
      foreach($autorizovani as $auto):

      if($auto->meniLink=="korpa"):?>

      <li><a href="index.php?page=<?=$auto->meniLink?>" ><i class="<?=$auto->meniTekst?>"></i></a></li>

      <?php else:?>

      <li><a href="index.php?page=<?=$auto->meniLink?>" ><?=$auto->meniTekst?></a></li>

      <?php endif; endforeach; endif;?>

      <?php $admini=izvrsiUpit("SELECT * FROM gornjimeni WHERE flag=5"); #flag=5; Linkovi koje vide samo admini

      if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv==="Admin"):
      
      foreach($admini as $admin):?>

      <li><a href="index.php?page=<?=$admin->meniLink?>" ><?=$admin->meniTekst?></a></li>

      <?php endforeach; endif;?>

      <?php $prijavljeni=izvrsiUpit("SELECT * FROM gornjimeni WHERE flag=3"); #flag=3; Linkovi koje vide svi prijavljeni korisnini
      
      if(isset($_SESSION['korisnik'])):
      
      foreach($prijavljeni as $prj):?>

      <li><a href="modules/<?=$prj->meniLink?>" ><?=$prj->meniTekst?></a></li>

      <?php endforeach; endif;?>


      </ul>
    </div>
   
  </div>
</nav>


