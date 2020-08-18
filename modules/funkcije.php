<?php
    function izvrsiUpit($upit){
        global $konekcija;
        $rez=$konekcija->query($upit)->fetchAll();
        return $rez;
    }
?>

