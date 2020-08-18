<?php
    session_start();

  
    if(isset($_POST['btnLogin'])){
        $email=$_POST['tbEmail'];
        $lozinka=$_POST['tbLozinka'];

        $reLozinka="/^[\S]{6,}$/";
        $greske=[];

        if(!preg_match($reLozinka,$lozinka)){
            $greske[]="Lozinka ne valja";
        }
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $greske[]="Email ne valja";
        }

        if(count($greske)>0){
            $_SESSION['greske']="Neispravni email ili lozinka";
            header("Location:../index.php?page=login");
        }
        else{
            require_once("konekcija.php");
            $lozinka=md5($lozinka);
            $upit="SELECT k.*, u.ulogaNaziv FROM korisnik k INNER JOIN uloga u on k.idUloga=u.idUloga
             where k.email=:email AND k.lozinka=:lozinka AND k.aktivan=1";

            $slanje=$konekcija->prepare($upit);
            $slanje->bindParam(":email",$email);
            $slanje->bindParam(":lozinka",$lozinka);
            $slanje->execute();
            $rezultat=$slanje->fetch();
            if($rezultat){
                $_SESSION['korisnik']=$rezultat;
                header("Location:../index.php?page=login");
            }else{
                $_SESSION['greske']="Pogresan email ili password";
                header("Location:../index.php?page=login");
            }
        }
    }
    

?>