<?php
    session_start();
    if(isset($_POST['btnIzmenaArtikla'])):
        require_once("konekcija.php");

        $id=$_POST['skrivenoUpdate'];
        $naziv=$_POST['nazivArtiklaUpdate'];
        $kategorija=$_POST['ddlKategorijaUpdate'];
        $cena=$_POST['cenaArtiklaUpdate'];
        $opis=$_POST['opisArtiklaUpdate'];
        $alt=$_POST['altArtiklaUpdate'];
        
        $file=$_FILES['slikaArtiklaUpdate'];
            
        $datumIzForme=$_POST['datumUpdate'];
        $datumNiz=explode("-",$datumIzForme);
        $timestamp=mktime(0,0,0,$datumNiz[1],$datumNiz[2],$datumNiz[0]);
        
        $datumUnos=date("Y-m-d H:i:s",$timestamp);

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
       

         if($file['name']==''){
           
            if(count($greske)){
            
                $_SESSION['greskeUpdate']="Niste uneli ispravno sve podatke";
                header("Location:../index.php?page=admin/proizvodi");
            
            }else{
                $upit="UPDATE artikal SET naziv=:naziv,opis=:opis,alt=:alt,cena=:cena,idKategorija=:idKategorija,datumPost=:datumPost 
                WHERE idArtikal=:idArtikal";
                $salji=$konekcija->prepare($upit);
                $salji->bindParam(":naziv",$naziv);
                $salji->bindParam(":opis",$opis);
                $salji->bindParam(":alt",$alt);
                $salji->bindParam(":cena",$cena);
                $salji->bindParam(":idKategorija",$kategorija);
                $salji->bindParam(":datumPost",$datumUnos);
                $salji->bindParam(":idArtikal",$id);


                if($salji->execute()){
                    $_SESSION['greskeUpdate']="Artikal je uspešno izmenjen";
                }
                else{
                    $_SESSION['greskeUpdate']="Greška, artikal nije izmenjen";
                }
                header("Location:../index.php?page=admin/proizvodi");
            }

        }
        else{
            $dozvoljeniFormati=['image/jpeg','image/jpg','image/png','image/gif'];
           
            $size=$file['size'];
            $type=$file['type'];
            $tmp=$file['tmp_name'];
            $fileName=$file['name'];
            $fajl=time()."-".$fileName;
            $path='../img/'.$fajl;
            $putanjaBaza='img/'.$fajl;
            $staraSlika='../'.$_POST['srcSlike'];
            
            unlink($staraSlika);

            if(!in_array($type,$dozvoljeniFormati)){
                array_push($greske,"Tip fajla nije odgovarajici");
            }
            if($size>2000000){
                array_push($greske,"Velicina fajla nije odgovarajica");
            }

            if(count($greske)){
            
                $_SESSION['greskeUnos']=$greske;
                header("Location:../index.php?page=admin/proizvodi");

            }elseif(move_uploaded_file($tmp,$path)){
                
                $upit="UPDATE artikal SET naziv=:naziv,opis=:opis,slika=:slika,alt=:alt,cena=:cena,idKategorija=:idKategorija,datumPost=:datumPost 
                WHERE idArtikal=:idArtikal";
                $salji=$konekcija->prepare($upit);
                $salji->bindParam(":naziv",$naziv);
                $salji->bindParam(":opis",$opis);
                $salji->bindParam(":alt",$alt);
                $salji->bindParam(":cena",$cena);
                $salji->bindParam(":idKategorija",$kategorija);
                $salji->bindParam(":datumPost",$datumUnos);
                $salji->bindParam(":idArtikal",$id);
                $salji->bindParam(":slika",$putanjaBaza);
                $salji->execute();

                if($salji->rowCount()){
                    $_SESSION['greskeUpdate']="Artikal je uspešno izmenjen";
                   
                }
                else{
                    $_SESSION['greskeUpdate']="Greška, artikal nije izmenjen";
                }

               
               header("Location:../index.php?page=admin/proizvodi");
                
            }
       }
       
    endif;
?>