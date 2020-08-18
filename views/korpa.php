<?php
	if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv=="Korisnik"): ?>

		<div class="container contentTabela" id="korpa1">
			
		</div>

		<button type="button" id='kupi' class='btn btn-primary'>Kupi</button>
<?php endif;?>