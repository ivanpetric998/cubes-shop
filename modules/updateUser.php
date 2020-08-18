<?php
    session_start();
    require_once("konekcija.php");
    if(isset($_POST['btnIzmena']) && $_SESSION['korisnik']->ulogaNaziv==="Admin"){

        $korisnikId=$_POST['skriveno'];
        $ime=$_POST['tbIme'];
        $prezime=$_POST['tbPrezime'];
        $username=$_POST['tbUsername'];
        $email=$_POST['tbEmail'];
        $lozinka=$_POST['tbLozinka'];
        $aktivan=isset($_POST['chbAktivan'])?$_POST['chbAktivan']:false;
        $pol=isset($_POST['pol'])?$_POST['pol']:null;
        $datumIzForme=$_POST['datum'];
        
        $datumNiz=explode("-",$datumIzForme);
        $timestamp=mktime(0,0,0,$datumNiz[1],$datumNiz[2],$datumNiz[0]);
        $datumUnos=date("Y-m-d H:i:s",$timestamp);
        $uloga=$_POST['ddlUloga'];
        $greske=[];

        $reimeprez="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/";
        $repass="/^\S{6,30}$/";
        $reuser="/^[\d\w\_\-\.@]{4,30}$/";
       

        if($uloga==0){
            array_push($greske, "Niste uneli ulogu korisnika");
        }
        if(!preg_match($reimeprez, $ime)){
            array_push($greske, "Ime nije u dobrom formatu");
        }
        
        if(!preg_match($reimeprez, $prezime)){
            array_push($greske, "Prezime nije u dobrom formatu");
        }
        
        if(!preg_match($reuser, $username)){
            array_push($greske, "Korisnicko ime nije u dobrom formatu");
        }

        
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($greske, "Email nije u dobrom formatu");
        }

        if(empty($pol)){
            array_push($greske, "Niste uneli pol");
        }

        if(count($greske)){
           $_SESSION['poruka']="Niste ispravno uneli sve podatke";
        }
        else{
            if($lozinka==""){
                $upit="UPDATE korisnik SET idKorisnik=:idKorisnik,ime=:ime,prezime=:prezime,
                korisnickoIme=:korisnickoIme,email=:email,pol=:pol,aktivan=:aktivan,
                idUloga=:idUloga,datumReg=:datumReg WHERE idKorisnik=:idKorisnik";
                $salji=$konekcija->prepare($upit);
                $salji->bindParam(":ime",$ime);
                $salji->bindParam(":prezime",$prezime);
                $salji->bindParam(":email",$email);
                $salji->bindParam(":datumReg",$datumUnos);
                $salji->bindParam(":aktivan",$aktivan);
                $salji->bindParam(":idKorisnik",$korisnikId);
                $salji->bindParam(":idUloga",$uloga);
                $salji->bindParam(":pol",$pol);
                $salji->bindParam(":korisnickoIme",$username);

                if($salji->execute()){
                    $_SESSION['poruka']="Korisnik je uspešno izmenjen";
                }
                else{
                    $_SESSION['poruka']="Greška, korisnik nije izmenjen";
                }
            }
            else{
                if(!preg_match($repass, $lozinka)){
                    $_SESSION['poruka']="Niste ispravno uneli sve podatke";
                }else{
                    $lozinka=md5($lozinka);
                    $upit="UPDATE korisnik SET idKorisnik=:idKorisnik,ime=:ime,prezime=:prezime,
                    korisnickoIme=:korisnickoIme,email=:email,lozinka=:lozinka,pol=:pol,aktivan=:aktivan,
                    idUloga=:idUloga,datumReg=:datumReg WHERE idKorisnik=:idKorisnik";
                    $salji=$konekcija->prepare($upit);
                    $salji->bindParam(":ime",$ime);
                    $salji->bindParam(":prezime",$prezime);
                    $salji->bindParam(":email",$email);
                    $salji->bindParam(":datumReg",$datumUnos);
                    $salji->bindParam(":aktivan",$aktivan);
                    $salji->bindParam(":idKorisnik",$korisnikId);
                    $salji->bindParam(":idUloga",$uloga);
                    $salji->bindParam(":pol",$pol);
                    $salji->bindParam(":lozinka",$lozinka);
                    $salji->bindParam(":korisnickoIme",$username);
                    if($salji->execute()){
                        $_SESSION['poruka']="Korisnik je uspešno izmenjen";
                    }
                    else{
                        $_SESSION['poruka']="Greška, korisnik nije izmenjen";
                    }
                }
                

            }
        }


        header("Location:../index.php?page=korisnici");


       
        
            
        
    }
?>