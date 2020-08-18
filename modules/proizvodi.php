<?php
    require_once("konekcija.php");
    require_once("funkcije.php");
    header("Content-type:application/json");

    $data=null;

    if(isset($_POST['id']) && isset($_POST['idKat'])){
        $strana=($_POST['id']-1)*4;
        $idKat=$_POST['idKat'];

        if($_POST['idKat']=='0'){
            $sviProizvodi=izvrsiUpit("SELECT * FROM artikal ORDER BY datumPost DESC LIMIT $strana, 4");
        }
        else{   
            $sviProizvodi=izvrsiUpit("SELECT * FROM artikal WHERE idKategorija=$idKat ORDER BY datumPost DESC LIMIT $strana, 4");
        }
            $data=$sviProizvodi;
    }
    
    echo json_encode($data);

?>