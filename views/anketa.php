<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mx-auto padding" id="anketa">

        <?php
                $anketa=$konekcija->query("SELECT * FROM anketa")->fetch();
                
        ?>


            <h3><?= $anketa->pitanje;?>?</h3>


            <form class='form-horizontal' id="formaGlasanje">

            <?php
                $upitOdgovori=izvrsiUpit("SELECT * FROM anketa a INNER join odgovor o on a.idAnketa=o.idAnketa WHERE a.aktivna=1");
                foreach($upitOdgovori as $odgovor):
            ?>

           
                <div class="radio">
                    <label><input type="radio" class="radioAnketa" name="radioAnketa" value="<?= $odgovor->idOdgovor;?>"/><?= $odgovor->odgovor;?></label>
                </div>
                
                <?php endforeach;?>
                <input type="hidden" id="skrivenoOdgovor" value="<?= $_SESSION['korisnik']->idKorisnik;?>">
            </form>
            <div class="controls">

                    <?php
                        $daLiJeGlasao="SELECT * from anketa a INNER JOIN odgovor o on a.idAnketa=o.idAnketa INNER JOIN glasanje g on o.idOdgovor=g.idOdgovor WHERE a.aktivna=1 AND g.idKorisnik=:korisnik";
                        $saljiDaLiJeGlasao=$konekcija->prepare($daLiJeGlasao);
                        $saljiDaLiJeGlasao->bindParam(":korisnik",$_SESSION['korisnik']->idKorisnik);
                        $saljiDaLiJeGlasao->execute();
                        if($saljiDaLiJeGlasao->rowCount()==0):?>

                    <button class='btn btn-success register' type='button' id="glasanje">Glasaj</button>

                <?php else: echo "Već ste iskoristili pravo glasa"; endif;  ?>
            </div>
           
        </div>
        <div id="odgovor">

        </div>
    </div>
</div>