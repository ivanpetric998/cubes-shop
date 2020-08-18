<?php
    if(isset($_POST['id'])){
        $id=$_POST['id'];
        require_once("konekcija.php");  
        $code=404;
      
        $upit="DELETE FROM korisnik WHERE idKorisnik=:id";
        $slanje=$konekcija->prepare($upit);
        $slanje->bindParam(":id",$id);
        try{
            $rezultat=$slanje->execute();
            if($rezultat){
                $code=204;
            }
            else{
                $code=500;
            }
        }
        catch(PDOException $e){
            $code=409;
        }
        http_response_code($code);
    }
?>