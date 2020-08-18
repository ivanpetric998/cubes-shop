<?php
    header("Content-type:application/json");
    if(isset($_POST['send'])){
        require_once("konekcija.php");
        require_once("funkcije.php");

        $data=null;
        $code=404;

        $idKorisnik=$_POST['skriveno'];
        $idOdgovor=$_POST['odgovor'];

        $upit="INSERT INTO glasanje(idOdgovor, idKorisnik) VALUES (:odgovor,:korisnik)";
        $slanje=$konekcija->prepare($upit);
        $slanje->bindParam(":odgovor",$idOdgovor);
        $slanje->bindParam(":korisnik",$idKorisnik);

        try {
            if($slanje->execute()){
                $upit2=izvrsiUpit("SELECT o.odgovor,count(g.idOdgovor) as broj FROM odgovor o LEFT OUTER JOIN glasanje g on o.idOdgovor=g.idOdgovor GROUP BY o.odgovor");   
                $data=$upit2;
                $code=201;                    
            }
            else{
                $code=500;
            }
            
        } catch (PDOException $e) {
           $code=409;
        }
       
            
        http_response_code($code);
        echo json_encode($data);

       
        
    }

   
?>