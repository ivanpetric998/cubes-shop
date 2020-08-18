<?php
	session_start();
	require_once("modules/konekcija.php");
	require_once("modules/funkcije.php");
	require_once("views/head.php");
	require_once("views/nav.php");
	
	if(isset($_GET['page'])){
		
		$page=$_GET['page'];
		switch($page){
			case 'home':require_once("views/home.php");break;
			case 'galerija':require_once("views/galerija.php");break;
			case 'autor':require_once("views/autor.php");break;
			case 'kontakt':require_once("views/kontakt.php");break;
			case 'registracija':require_once("views/registracija.php");break;
			case 'login':require_once("views/slajder.php");require_once("views/login.php");break;
			case 'proizvodi':require_once("views/proizvodi.php");break;
			case 'proizvod':require_once("views/proizvod.php");break;
			case 'korpa':require_once("views/korpa.php");break;
			case 'admin/proizvodi':require_once("views/admin.php");break;
			case 'korisnici':require_once("views/korisnici.php");break;
			case 'insert':require_once("views/insert.php");break;
			case 'anketa':require_once("views/slajder.php");require_once("views/anketa.php");break;
			default:require_once("views/home.php");break;
		}
	}
	else{
		require_once("views/home.php");
	}
	
	require_once("views/futer.php");
?>


