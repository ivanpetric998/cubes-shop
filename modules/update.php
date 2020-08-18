<?php
    header("Content-type:application/json");
    if(isset($_POST['id'])){
           
        $id=$_POST['id'];
        require_once("konekcija.php");

        $code=404;
        $data=null;
        $upit="SELECT * FROM korisnik k INNER JOIN uloga u ON k.idUloga=u.idUloga WHERE idKorisnik=:id";
       
        $slanje=$konekcija->prepare($upit);
        $slanje->bindParam(":id",$id);
        
            $slanje->execute();
            $rezultat=$slanje->fetch();
            
           if($rezultat){
                $data=$rezultat;
                $code=200;
            }
            else{
                $code=500;
            }
        http_response_code($code);
        echo json_encode($data); 
    }
   
?>