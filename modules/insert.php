<?php
    session_start();
    if(isset($_POST['btnUnosProizvoda'])):
        require_once("konekcija.php");
        $dozvoljeniFormati=['image/jpeg','image/jpg','image/png','image/gif'];
        $file=$_FILES['slikaArtikla'];
        $size=$file['size'];
        $type=$file['type'];
        $tmp=$file['tmp_name'];
        $fileName=$file['name'];
        $fajl=time()."-".$fileName;
        $path="../img/".$fajl;
        $putanjaBaza="img/".$fajl;

        $naziv=$_POST['nazivArtikla'];
        $kategorija=$_POST['ddlKategorija'];
        $cena=$_POST['cenaArtikla'];
        $opis=$_POST['opisArtikla'];
        $alt=$_POST['altArtikla'];
        $greske=[];

        $reNaziv="/^[\w\d\s]+$/";
        $reCena="/^\d+$/";

        if(!preg_match($reNaziv,$naziv)){
            array_push($greske,"Ime nije u dobrom formatu");
        }
        
        if(!preg_match($reCena,$cena)){
            array_push($greske,"Cena nije u dobrom formatu");
        }

        if($kategorija=='0'){
            array_push($greske,"Morate izabrati kategoriju");
        }
        if($opis==''){
            array_push($greske,"Morate uneti opis");
        }
        if($alt==''){
            array_push($greske,"Morate uneti alt slike");
        }

        if(!in_array($type,$dozvoljeniFormati)){
            array_push($greske,"Tip fajla nije odgovarajici");
        }
        if($size>2000000){
            array_push($greske,"Velicina fajla nije odgovarajica");
        }

        if(count($greske)){
            
            $_SESSION['greskeUnos']=$greske;
            header("Location:../index.php?page=insert");
        }elseif(move_uploaded_file($tmp,$path)){
            
            $upit="INSERT INTO artikal (naziv,opis,slika,alt,cena,idKategorija) VALUES (:naziv,:opis,:slika,:alt,:cena,:kategorija)";
            $salji=$konekcija->prepare($upit);
            $salji->bindParam(":naziv",$naziv);
            $salji->bindParam(":cena",$cena);
            $salji->bindParam(":opis",$opis);
            $salji->bindParam(":slika",$putanjaBaza);
            $salji->bindParam(":alt",$alt);
            $salji->bindParam(":kategorija",$kategorija);
            $salji->execute();
            if($salji->rowCount()){
                $poruka="Uspesan unos";
                header("Location:../index.php?page=insert&poruka=$poruka");
            }
        }

    endif;
?>