<?php

    if(isset($_POST['id'])){
      
        $id=$_POST['id'];
        require_once("konekcija.php");

        
        $code=404;
       
        $upit="DELETE FROM artikal WHERE idArtikal=:id";
        $slanje=$konekcija->prepare($upit);
        $slanje->bindParam(":id",$id);

        $staraSlika='../'.$_POST['slika'];
        unlink($staraSlika);
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
            $code=500;
        }

        http_response_code($code);
        

        
    }
   
?>