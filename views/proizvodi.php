<div id="services">
  <div class="container">
    <div class="col-md-10 col-md-offset-1 section-title text-center">
      <h2>Naši proizvodi</h2>
      <hr>
      
	  
	  <div id="search" class="search-container">

		<input type="text" placeholder="Search.." name="search" id="poljeSearch">
		<button type="button" class="btn-primary" id="dugmeSearch"><i class="fa fa-search" ></i></button>
	</div>
 
	 <select id="filter" name='filter'>
		  <option value="0">Filtriraj po kategoriji</option>

      <?php $kategorije=izvrsiUpit("SELECT * FROM kategorija"); foreach($kategorije as $kategorija):?>

      <option value="<?=$kategorija->idKategorija?>"><?=$kategorija->nazivKategorija?></option>

      <?php endforeach;?>
   </select>
  
    </div>

    <div class="row" id="sviProizvodi">

    </div>
    <div id="paginacija">
        <ul class="pagination" id="paginacija2">

        </ul> 
    </div>
    
  </div>
</div>



