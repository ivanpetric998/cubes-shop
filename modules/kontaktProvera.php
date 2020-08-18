<?php
    if(isset($_POST['send'])){
        $ime=$_POST['ime'];
        $email=$_POST['email'];
        $poruka=$_POST['poruka'];
        $greske=[];
        $ispis="";
        $reIme="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14}){1,}$/";

        if(!preg_match($reIme,$ime)){
            $greske[]="Ime i prezime nisu u dobrom formatu";
        }

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $greske[]="Email nije u dobrom formatu";
        }

        if($poruka==""){
            $greske[]="Poruka nije u dobrom formatu";
        }

        if(count($greske)){
            for ($i=0; $i <count($greske) ; $i++) { 
                $ispis+=$greske[i]."<br>";
            }
           
        }else{
            $ispis="Uspešno ste poslali poruku!";
        }
        echo $ispis;
    }
?>