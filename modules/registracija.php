<?php 
    require_once("konekcija.php");
    header("Content-type:application/json");
    if(isset($_POST['flag'])){
        $ime=$_POST['ime'];
        $prezime=$_POST['prezime'];
        $username=$_POST['username'];
        $email=$_POST['email'];
        $lozinka=$_POST['lozinka'];
        $pol=isset($_POST['pol'])?$_POST['pol']:null;

        $greske=[];
        $code=404;
        $data=null;
        $reimeprez="/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,20})*$/";
        $repass="/^\S{6,30}$/";
        $reuser="/^[\d\w\_\-\.@]{4,30}$/";


        if(!preg_match($reimeprez, $ime)){
            array_push($greske, "Ime nije u dobrom formatu");
        }
        
        if(!preg_match($reimeprez, $prezime)){
            array_push($greske, "Prezime nije u dobrom formatu");
        }
        
        if(!preg_match($reuser, $username)){
            array_push($greske, "Korisnicko ime nije u dobrom formatu");
        }

        if(!preg_match($repass, $lozinka)){
            array_push($greske, "Lozinka nije u dobrom formatu");
        }
        
        if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
            array_push($greske, "Email nije u dobrom formatu");
        }

        if(empty($pol)){
            array_push($greske, "Niste uneli pol");
        }

        if(count($greske)){
            $data=$greske;
            $code=422;
        }
        else{
            $lozinka=md5($lozinka);
            $upit="INSERT INTO korisnik(ime,prezime,email,lozinka,korisnickoIme,idUloga,aktivan,pol) 
            VALUES(:ime,:prezime,:email,:lozinka,:username,2,1,:pol)";
            $izvrsenje=$konekcija->prepare($upit);
            $izvrsenje->bindParam(":ime",$ime);
            $izvrsenje->bindParam(":prezime",$prezime);
            $izvrsenje->bindParam(":email",$email);
            $izvrsenje->bindParam(":username",$username);
            $izvrsenje->bindParam(":lozinka",$lozinka);
            $izvrsenje->bindParam(":pol",$pol);
            try {
                $code=$izvrsenje->execute()?201:500;
            } catch (PDOException $e) {
                $code=409;
            }
        }
        http_response_code($code);
        echo json_encode($data);
    }
    
?>