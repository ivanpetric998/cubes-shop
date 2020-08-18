<?php
    require_once("konekcija.php");
    require_once("funkcije.php");
    header("Content-type:application/json");

    $code=404;
    $data=null;
    
    $sviProizvodi=izvrsiUpit("SELECT * FROM artikal");

    if($sviProizvodi){
        $data=$sviProizvodi;
        $code=200;
    }
    else{
        $code=500;
    }

    http_response_code($code);
    echo json_encode($data);

?>