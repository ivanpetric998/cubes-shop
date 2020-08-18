<div class="container">
    <div class="row">
        <div class="col-lg-4  forma" id="login">
            <?php if(isset($_SESSION['korisnik'])):
                header("location:index.php");
             else:?>
            <h2>Logovanje</h2>
            <form method='POST' action='modules/logovanje.php'>
                <div class="form-group">
                    <input type="text" name="tbEmail" placeholder='Vas email' class='form-control'>
                </div>
                <div class="form-group">
                    <input type="password" name="tbLozinka" placeholder='Vasa Lozinka' class='form-control'>
                </div>
                <input type="submit" value="Ulogujte se" name='btnLogin' class='brn btn-success register'>
				
            </form>
            <?php endif;?>

            <?php
                if(isset($_SESSION['greske'])){
                    $greska=$_SESSION['greske'];
                    echo($greska);
                    unset($_SESSION['greske']);
                }
            ?>
        </div>
    </div>
</div>