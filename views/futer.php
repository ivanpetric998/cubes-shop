
<div id="footer">
  <div class="container text-center">
    <div class="social">
      <ul>

      <?php $faSvi=izvrsiUpit("SELECT * FROM fameni"); foreach($faSvi as $fa):?>

      <li><a href="<?=$fa->faLink?>"><i class="<?=$fa->faTekst?>"></i></a></li>

      <?php endforeach;?>

      </ul>
    </div>
    <div>
      <p>&copy; Ivan Petrić, Designed by / <a href="http://www.templatewire.com" rel="nofollow">TemplateWire</a> /
      <a href="" rel="nofollow">Dokumentacija</a> / <a href="sitemap.xml" rel="nofollow">Sitemap</a> / 
      <a href="index.php?page=autor" >Autor</a> / 
      <?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv=="Korisnik"): ?>
      <a href="index.php?page=anketa" >Anketa</a>
      <?php endif;?>
	  </p>
    </div>
  </div>
</div>


<script src='https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/main.js"></script>
<script src="js/lightbox.min.js"></script>
</body>
</html>
