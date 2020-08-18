<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mx-auto padding forma">
        <form class='form-horizontal'>
                <div class="control-group">
                    <h2>Registracija</h2>
                </div>
                <div class="control-group">
                    <label class='control-label' for='ime'>Ime</label>
                    <div class="form-group">
                        <input type="text"class="form-control" id="ime">
                        <p class='help-block'>Ime mora pocinjati velikim slovom, osoba moze imati vise imena</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='prezime'>Prezime</label>
                    <div class="form-group">
                        <input type="text"class="form-control" id="prezime">
                        <p class='help-block'>Prezime mora pocinjati velikim slovom, osoba moze imati vise prezimena</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='username'>Korisnicko ime</label>
                    <div class="form-group">
                        <input type="text"class="form-control" id="username">
                        <p class='help-block'>Korisnicko ime moze da sadrzi bilo koje slovo, broj ili specijalni karakter bez razmaka</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='email'>E-mail</label>
                    <div class="form-group">
                        <input type="text"class="form-control" id="email">
                        <p class='help-block'>Molimo vas ostavite Vas e-mail</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='lozinka'>Lozinka</label>
                    <div class="form-group">
                        <input type="password"class="form-control" id="lozinka">
                        <p class='help-block'>Lozinika treba da ima najmanje 6 karaktera</p>
                    </div>
                </div>
                <div class="radio">
                    <label><input type="radio" name="pol" value="M">Muski</label>
                    </div>
                    <div class="radio">
                    <label><input type="radio" name="pol" value="Z">Zenski</label>
                    </div><br>
                    
                <div class="control-group">
                    <div class="controls">
                        <button class='btn btn-success register' type='button' id="btnRegistracija">Registruj se</button>
                    </div>
                    <div id="poruka"></div>
                </div>
            </form>
       
        </div>
    </div>
</div>