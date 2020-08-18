<?php
    require_once("konekcija.php");
    require_once("funkcije.php");
    header("Content-type:application/json");

    $data=null;

    if(isset($_POST['id'])){
        $strana=($_POST['id']-1)*4;       
            $sviProizvodi=izvrsiUpit("SELECT * FROM artikal LIMIT $strana, 4");
            $data=$sviProizvodi;
    }
    
    echo json_encode($data);

?>