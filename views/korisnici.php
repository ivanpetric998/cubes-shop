<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->ulogaNaziv==='Admin'):?>

<div class="container contentTabela" >

		<?php
			$upitKorisnici=izvrsiUpit("SELECT k.*,u.ulogaNaziv FROM korisnik k INNER JOIN uloga u on k.idUloga=u.idUloga");
			$rb=1;
		?>
			<table class="korpa" border="1">
				<thead>
					<tr>
						<th>Redni broj</th>
						<th>Ime</th>
                        <th>Prezime</th>
                        <th>Korisnicko ime</th>
						<th>Uloga</th>
						<th>Podešavanja</th>
					</tr>
				</thead>
				<tbody>

					<?php foreach ($upitKorisnici as $korisnik):?>

					<tr class="rem1">
						<td><?= $rb++;?></td>
						<td><?= $korisnik->ime;?></td>
						<td><?= $korisnik->prezime;?></td>
						<td><?= $korisnik->korisnickoIme;?></td>
						<td><?= $korisnik->ulogaNaziv;?></td>
						<td>
							<a href='#' data-id="<?= $korisnik->idKorisnik;?>" class='btn btn-primary obrisi'>Obrisi</a>
							<a href='#' data-id="<?= $korisnik->idKorisnik;?>" class='btn btn-primary azuriraj'>Azuriraj</a>
						</td>
					</tr>

					<?php endforeach;?>
				</tbody>
			</table>
		</div>

		<div class="row">
            <div class="col-md-4 mx-auto" id="podaci">
                <form method="POST" action="modules/updateUser.php">
                    <div class="form-group">
                        <input type="text" name="tbIme" id="tbIme" placeholder='Ime' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tbPrezime" id="tbPrezime" placeholder='Prezime' class='form-control'>
                    </div>
					<div class="form-group">
                        <input type="text" name="tbUsername" id="tbUsername" placeholder='Korisničko ime' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tbEmail" id="tbEmail" placeholder='E-mail' class='form-control'>
                    </div>
                    
                    <div class="form-group">
                       <select name='ddlUloga' id='ddlUloga' class=form-control>
                            <option value='0'>Izaberite</option>

                            <?php 
                             
                                $upitUloge=izvrsiUpit("SELECT * FROM uloga");
                                
                                foreach ($upitUloge as $value):?>
                                    <option value="<?=$value->idUloga?>"><?=$value->ulogaNaziv?></option>
                                <?php endforeach; 
                               
                            ?>
                       </select>
                    </div>
                    <div class="form-group">  
                        <input type="date" name="datum" id="datum" class=form-control>
                    </div>
                    <div class="form-group">
                        <input type="password" name="tbLozinka" id="tbLozinka" placeholder='Lozinka' class='form-control'>
                    </div>
                    <input type="button" value="Izmena lozinke" id='izmenaLozinke' class='btn btn-primary'>
					<div class="radio">
                    <label><input type="radio" name="pol" value="M">Muski</label><br/>
                    </div>
                    <div class="radio">
                    <label><input type="radio" name="pol" value="Z">Zenski</label><br/>
                    </div>
                    <div class="form-group">  
                        <input type="hidden" name="skriveno" id="skriveno" class=form-control>
                        <label>Aktivan korisnik da / ne </label>&nbsp;   
                        <input type="checkbox" name="chbAktivan" id="chbAktivan" value='1'>
                    </div>
                    <input type="submit" value="Izmeni" name='btnIzmena' id='btnIzmena' class='btn btn-primary'>
                    <input type="button" value="Sakri" id='sakri' class='btn btn-primary'>

                </form>

                
            </div>

        </div>
			<div class="odgovorUpdate">
            <?php if(isset($_SESSION['poruka'])):
                    
                    echo $_SESSION['poruka'];
                    unset($_SESSION['poruka']);
                    
                endif; ?>
            </div>
<?php endif;?>
		