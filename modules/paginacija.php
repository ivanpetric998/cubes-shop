<?php

    header("Content-type:application/json");
    require_once("konekcija.php");
   
    $data=null;

    if(isset($_POST['id'])){
        $id=$_POST['id'];
        if($id!=0){
            $paginacija=$konekcija->query("SELECT COUNT(*) AS brojSlika FROM artikal WHERE idKategorija=$id")->fetch();
        }
        else{
            $paginacija=$konekcija->query("SELECT COUNT(*) AS brojSlika FROM artikal")->fetch();
        }
        $data=$paginacija;
    }

    echo json_encode($data);

?>

