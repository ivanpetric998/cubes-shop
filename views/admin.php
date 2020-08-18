<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv==='Admin'):?>

<div class="container contentTabela" >

		<?php
			$upitArtikli=izvrsiUpit("SELECT a.*,k.nazivKategorija FROM artikal a INNER JOIN kategorija k on a.idKategorija=k.idKategorija");
			$rb=1;
		?>
			<table class="korpa" border="1">
				<thead>
					<tr>
						<th>Redni broj</th>
						<th>Naziv</th>
                        <th>Proizvod</th>
                        <th>Cena</th>
						<th>Kategorija</th>
						<th>Podešavanja</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($upitArtikli as $art):?>

					<tr class="rem1">
						<td><?= $rb++;?></td>
						<td><?= $art->naziv;?></td>
						<td><img src="<?= $art->slika;?>" alt="<?= $art->alt;?>" style="width:100px"/></td>
						<td><?= $art->cena;?> din</td>
						<td><?= $art->nazivKategorija;?></td>
						<td>
							<a href='#' data-id="<?= $art->idArtikal;?>" data-slika="<?= $art->slika;?>" class='btn btn-primary obrisiArtikal'>Obrisi</a>
							<a href='#' data-id="<?= $art->idArtikal;?>" class='btn btn-primary azurirajArtikal'>Azuriraj</a>
						</td>
					</tr>

					<?php endforeach;?>
				</tbody>
			</table>
		</div>

		<div class="row">
            <div class="col-md-4 mx-auto" id="azuriranjeArtikla">
            <form method="post" action="modules/updateProizvoda.php" enctype='multipart/form-data'>
                    <div class="form-group">
                        <input type="text" name="nazivArtiklaUpdate" id="nazivArtiklaUpdate" placeholder='Naziv proizvoda' class='form-control'>
                    </div>
                    <img src="" style="width:30%" alt="" id="prikazSlika">
                    <div class="form-group">
                        <label>Slika proizvoda : &nbsp;</label> <input type="file" name="slikaArtiklaUpdate" id="slikaArtiklaUpdate">
                    </div>
                    <input type="hidden" name="srcSlike" id="srcSlike" class=form-control>
                    <div class="form-group">
                        <input type="text" name="altArtiklaUpdate" id="altArtiklaUpdate" placeholder='Alt proizvoda' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="text" name="cenaArtiklaUpdate" id="cenaArtiklaUpdate" placeholder='Cena proizvoda' class='form-control'>
                    </div>
                    <div class="form-group">
                    <textarea class="tekstForme brisanje" rows="7" id="opisArtiklaUpdate" name="opisArtiklaUpdate" placeholder="Opis proizvodaUpdate" class='form-control'></textarea>
                    </div>
                    <div class="form-group">  
                        <input type="date" name="datumUpdate" id="datumUpdate" class=form-control>
                        <input type="hidden" name="skrivenoUpdate" id="skrivenoUpdate" class=form-control>
                    </div>
                    <label>Kategorija proizvoda : </label>
                    <div class="form-group">
                       <select name='ddlKategorijaUpdate' id='ddlKategorijaUpdate' class=form-control>
                            <option value='0'>Izaberite</option>

                            <?php 
                             
                                $upitKat=izvrsiUpit("SELECT * FROM kategorija");
                                
                                foreach ($upitKat as $kat):?>
                                    <option value="<?=$kat->idKategorija?>"><?=$kat->nazivKategorija?></option>
                                <?php endforeach; 
                               
                            ?>
                       </select>
                    </div>
                    
                                        
                    <input type="submit" value="Izmeni" name='btnIzmenaArtikla' id='btnIzmenaArtikla' class='btn btn-primary'>
                    <input type="button" value="Sakri" id='sakriAzuriranjeProizvoda' class='btn btn-primary'>

                    

                </form>

                
            </div>
            <div class="odgovorUpdate">

            <?php 
                   
                    if(isset($_SESSION['greskeUpdate'])){
                        $greskeUpdate=$_SESSION['greskeUpdate'];
                       
                       
                            echo "<p>$greskeUpdate</p>";
                      
                        unset($_SESSION['greskeUpdate']);
                    }
                     ?>
            </div>
           

        </div>
			
<?php endif;?>