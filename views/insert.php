<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv==='Admin'):?>
		<div class="row">
                   <div class="col-md-4 mx-auto" id="insertProizvoda">
            <h2>Unos proizvoda</h2>
                <form method="POST" action="modules/insert.php" enctype='multipart/form-data'>
                    <div class="form-group">
                        <input type="text" name="nazivArtikla" id="nazivArtikla" placeholder='Naziv proizvoda' class='form-control'>
                    </div>
                    <div class="form-group">
                        <label>Slika proizvoda : &nbsp;</label> <input type="file" name="slikaArtikla" id="slikaArtikla">
                    </div>
                    <div class="form-group">
                        <input type="text" name="altArtikla" id="altArtikla" placeholder='Alt proizvoda' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cenaArtikla" id="cenaArtikla" placeholder='Cena proizvoda' class='form-control'>
                    </div>
                    <div class="form-group">
                    <textarea class="tekstForme brisanje" rows="7" name="opisArtikla" placeholder="Opis proizvoda" class='form-control'></textarea>
                    </div>
                    <label>Kategorija proizvoda : </label>
                    <div class="form-group">
                       <select name='ddlKategorija' id='ddlKategorija' class=form-control>
                            <option value='0'>Izaberite</option>

                            <?php 
                             
                                $upitKat=izvrsiUpit("SELECT * FROM kategorija");
                                
                                foreach ($upitKat as $kat):?>
                                    <option value="<?=$kat->idKategorija?>"><?=$kat->nazivKategorija?></option>
                                <?php endforeach; 
                               
                            ?>
                       </select>
                    </div>
                    
                    
                    <input type="submit" value="Unesi" name='btnUnosProizvoda' id='btnUnosProizvoda' class='btn btn-primary'>&nbsp;
                   
                    <?php 
                    if(isset($_GET['poruka'])){
                                echo $_GET['poruka'];
                            }
                    if(isset($_SESSION['greskeUnos'])){
                        $greskeUnos=$_SESSION['greskeUnos'];
                       
                        foreach($greskeUnos as $jednaGreska){
                            echo "<p>$jednaGreska</p>";
                        }
                        unset($_SESSION['greskeUnos']);
                    }
                     ?>
                </form>

                
            </div>

        </div>
			
<?php endif;?>