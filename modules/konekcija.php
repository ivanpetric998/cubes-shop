<?php 
    
    $serverBaze='localhost';
    $username='root';
    $password='';
    $nazivBaze='rubikovakocka';
    try{
        $konekcija=new PDO("mysql:host=$serverBaze;dbname=$nazivBaze;charset=utf8",$username,$password);
        $konekcija->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
        $konekcija->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
    }
    catch(PDOException $e)
    {
        echo "Greska sa konekcijom:".$e->getMessage();
    }
?>
