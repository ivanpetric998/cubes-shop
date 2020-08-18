$(document).ready(function(){
	$("#dugme").click(function(){
        if($('#bs-example-navbar-collapse-1').is(':visible')) { 
             $('#bs-example-navbar-collapse-1').slideUp("slow");
        } else {
            $('#bs-example-navbar-collapse-1').slideDown("slow");
          }         
     });

     popuniSveProizvode();
     popuniGaleriju();
     prikaziPaginaciju(0);

     $("#btnRegistracija").click(function(){
       
          var ime=$("#ime").val();
          var prezime=$("#prezime").val();
          var username=$("#username").val();
          var email=$("#email").val();
          var lozinka=$("#lozinka").val();
          var pol=$("input[name='pol']:checked").val();

          var reimeprez=/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14})*$/;
          var repass=/^\S{6,30}$/;
          var reuser=/^[\d\w\_\-\.@]{4,30}$/;
          var reEmail = /^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/;

          var greske=[];

          if(!reimeprez.test(ime)) {
               greske.push("Ime nije u dobrom formatu");
          }
          if(!reimeprez.test(prezime)) {
               greske.push("Prezime nije u dobrom formatu");
          }
          if(!reuser.test(username)) {
               greske.push("Korisnicko ime nije u dobrom formatu");
          }
          if(!repass.test(lozinka)) {
               greske.push("Lozinka nije u dobrom formatu");
          }
          if(!reEmail.test(email)) {
               greske.push("Email nije u dobrom formatu");
          }
          if(!pol){
               greske.push("Niste izabrali pol");
          }

          if(greske.length){
               let ispis=`<ul>`;
               for(let greska of greske){
                    ispis+=`<li>${greska}</li>`
               }
               ispis+=`</ul>`;
               $("#poruka").html(ispis);
          }
          else{
               $("#poruka").html("");
               var obj={
                    ime:$("#ime").val(),
                    prezime:$("#prezime").val(),
                    username:$("#username").val(),
                    email:$("#email").val(),
                    lozinka:$("#lozinka").val(),
                    pol:pol,
                    flag:true
                   };
                   
                   $.ajax({
                    url : "modules/registracija.php",
                    method : "POST",
                    data:obj,
                    success : function(data) {
                        $("#poruka").html("Uspesno ste se registrovali");
                    },
                    error : function(xhr, status, error) {
                        var poruka="Doslo je do greske";
                        switch(xhr.status){
                            case 404:poruka="Stranica nije pronadjena";break;
                            case 409:poruka="Username ili email vec postoji";break;
                            case 422:poruka="Podaci nisu validni";;break;
                            case 500:poruka="Greska";break;
                        }
                        $("#poruka").html(poruka);
                    }
                });
          }

     });  


     $("#filter").change(function(){

          let idKat=$(this).val();
          prikaziPaginaciju(idKat);

          $.ajax({
               url:"modules/proizvodi.php",
               dataType:"json",
               data:{
                    id:1,
                    idKat:idKat
               },
               method:"post",
               success:function(data){
          
                    ispisiProizvode(data);
               },
               error:function(xhr,status,data){
                   
                         alert(xhr.status + status);
                    
                    
               }
          });

     });

     

     $("#paginacija").on("click",".pag",function(){
          let id=$(this).data("id");
          let idKat=$("#filter").val();
          $("#paginacija2 .active").removeAttr("class");
         
          $(this).parent().attr("class","active");
          
          $.ajax({
               url:"modules/proizvodi.php",
               dataType:"json",
               data:{
                    id:id,
                    idKat:idKat
               },
               method:"post",
               success:function(data){
          
                    ispisiProizvode(data);
               },
               error:function(xhr,status,data){
                    alert(xhr.status + status);
               }
          });

     })
     
     $("#dugmeSearch").click(function(){
          $.ajax({
               url:"modules/sviProizvodi.php",
               dataType:"json",
               method:"post",
               success:function(data){
                    
                    let tekst=$("#poljeSearch").val();
                    data=data.filter(p=>p.naziv.toUpperCase().indexOf(tekst.toUpperCase())!=-1);
                    ispisiProizvode(data);
                    $("#paginacija").hide();
               },
               error:function(xhr,status,data){
                    alert(xhr.status + status);
               }
          });
     });


     $(".pagGal").click(function(){
          let id=$(this).data("id");
          $("#paginacija4 .active").removeAttr("class");
         
          $(this).parent().attr("class","active");
          
          $.ajax({
               url:"modules/paginacijaGalerija.php",
               dataType:"json",
               data:{
                    id:id,
               },
               method:"post",
               success:function(data){
                    ispisiGal(data);
               },
               error:function(xhr,status,data){
                    alert(xhr.status + status);
               }
          });
     })

     
     $(".obrisi").click(function(){
          let poslati=confirm("Da li ste sigurni da zelite da obrisete korisnika?");
          let id=$(this).data("id");
          if(poslati){
               $.ajax({
                    url:"modules/delete.php",
                    dataType:"json",
                    method:"post",
                    data:{
                         id:id
                    },
                    success:function(data){
                        alert("Uspesno ste izbrisali korisnika");
                        
                    },
                    error:function(xhr,status,data){
                         if(xhr.status==409)$(".odgovorUpdate").html("Ne možete obrisati korisnika");
                         else{
                         alert(xhr.status + status);
                        } 
                    }
               });
          }
     });

     $(".obrisiArtikal").click(function(){
          let poslati=confirm("Da li ste sigurni da zelite da obrisete atrikal?");
          let id=$(this).data("id");
          let slika=$(this).data("slika");
          if(poslati){
               $.ajax({
                    url:"modules/deleteArtikal.php",
                    dataType:"json",
                    method:"post",
                    data:{
                         id:id,
                         slika:slika
                    },
                    success:function(data){
                        alert("Uspesno ste izbrisali artikal");
                        
                    },
                    error:function(xhr,status,data){
                         alert(xhr.status + status);
                    }
               });
          }
     });



     $(".azuriraj").click(function(e){
          e.preventDefault();
          $("#podaci").slideDown("slow");
          $('#tbLozinka').hide();
          $("#izmenaLozinke").show();
          var id=$(this).data('id');
          $.ajax({
              url : "modules/update.php",
              method : "POST",
              dataType:"json",
              data:{
                  id:id
              },
              success : function(data) {
                  $("#tbIme").val(data.ime);
                  $("#tbPrezime").val(data.prezime);
                  $("#tbEmail").val(data.email);
                  $("#tbUsername").val(data.korisnickoIme);
                  $("#ddlUloga").val(data.idUloga);
                  $("input[name='chbAktivan']").removeAttr('checked');
                  if(data.aktivan==1){
                      $("input[name='chbAktivan']").attr('checked',true);         
                  }
                  $("input[name='pol']").each(function(){
                       if($(this).val()==data.pol){
                            $(this).attr('checked',true);
                       }
                  });
                  var datum=data.datumReg.split(" ");
                  $("#datum").val(datum[0]);
                  $("#skriveno").val(data.idKorisnik);
              },
              error : function(xhr, status, error) {
                  switch(xhr.status){
                      case 404:alert("Stranica nije pronadjena");break;
                      case 500:alert("Greska na serveru.Trenutno nije moguce azurirati podatke o korisniku");break;
                      default:alert("Greska: "+xhr.status+"-"+status);break;
                  }
              }
          });
          
      });


      $(".azurirajArtikal").click(function(e){
          e.preventDefault();
          $("#azuriranjeArtikla").slideDown("slow");
          var id=$(this).data('id');
          $.ajax({
              url : "modules/updateFormaProizvod.php",
              method : "POST",
              dataType:"json",
              data:{
                  id:id
              },
              success : function(data) {
                  $("#nazivArtiklaUpdate").val(data.naziv);
                  $("#altArtiklaUpdate").val(data.alt);
                  $("#cenaArtiklaUpdate").val(data.cena);
                  $("#opisArtiklaUpdate").val(data.opis);
                  $("#skrivenoUpdate").val(data.idArtikal);
                  $("#ddlKategorijaUpdate").val(data.idKategorija);
                  
                  $("#srcSlike").val(data.slika);
                  
                  $("#prikazSlika").attr("src",data.slika);
                  $("#prikazSlika").attr("alt",data.alt);

                  var datum=data.datumPost.split(" ");
                  $("#datumUpdate").val(datum[0]);
                 
              },
              error : function(xhr, status, error) {
                  switch(xhr.status){
                      case 404:alert("Stranica nije pronadjena");break;
                      case 500:alert("Greska na serveru.Trenutno nije moguce azurirati podatke o korisniku");break;
                      default:alert("Greska: "+xhr.status+"-"+status);break;
                  }
              }
          });

         
          
      });

      $("#sakri").click(function(){
          $("#podaci").slideUp("slow");
      });

      $("#sakriAzuriranjeProizvoda").click(function(){
          $("#azuriranjeArtikla").slideUp("slow");
      });

     
     $("#izmenaLozinke").click(function(){
          
          if($(this).is(':visible')) { 
                $(this).slideUp();
                $('#tbLozinka').slideDown();
           } else {
               $(this).slideDown();
                $('#tbLozinka').slideUp();
           }         
     });

     if(!sviProizvodiUKorpi()){
          localStorage.setItem("proizvodi", JSON.stringify([]));
     }
    
     $(".dodajUKorpu").click(function(){
          var id=$(this).data("id");
          var proizvodi=sviProizvodiUKorpi();
               if(proizvodi.filter(p => p.id == id).length){
                    for(let proizvod of proizvodi){
                         if(proizvod.id == id) {
                              proizvod.kolicina++;
                              break;
                         }                          
                    }
                    localStorage.setItem("proizvodi", JSON.stringify(proizvodi));
               }
               else{
                    proizvodi.push({
                         id : id,
                         kolicina : 1
                     });
                     localStorage.setItem("proizvodi", JSON.stringify(proizvodi));
               }
     });

     popuniKorpu();

     $("#korpa1").on("click",".obrisiKorpu",function(){
          let proizvodi=sviProizvodiUKorpi();
          let id=$(this).data("id");
          let prikaz=proizvodi.filter(p=>p.id!=id);
          localStorage.setItem("proizvodi", JSON.stringify(prikaz));
          popuniKorpu();
     });

     $("#kupi").hide();

     

     if(sviProizvodiUKorpi()){

          if(sviProizvodiUKorpi().length){
               $("#kupi").show();
               $("#kupi").click(function(){
                    alert("Uspešno ste izvršili kupovinu");
                    localStorage.removeItem("proizvodi");
                    $("#kupi").hide();
               });
          }
         
     }
     if(!sviProizvodiUKorpi().length){
          $("#korpa1").html(`<table class="korpa"  border="1">
          <thead>
               <tr>
                    <th>Redni broj</th>
                    <th>Naziv</th>
                    <th>Proizvod</th>
                    
                    <th>Osnovna cena</th>
                    <th>Količina</th>
                    <th>Ukupna cena</th>
                    <th>Obriši</th>
               </tr>
          </thead></table>`);
     }
         
          

     $("#saljiPoruku").click(function(){
          var reIme=/^[A-Z][a-z]{2,14}(\s[A-Z][a-z]{2,14}){1,}$/;
          var reEmail=/^\w+([\.\-]\w+)*@\w+([\.\-]\w+)*(\.\w{2,4})+$/;

          var ime=$("#imePrezime").val();
          var email=$("#emailKorisnika").val();
          var poruka=$("#message").val();

          var greske=[];

          if(!reIme.test(ime)){
               greske.push("Ime i prezime nisu u dobrom formatu");
          }

          if(!reEmail.test(email)){
               greske.push("Email nije u dobrom formatu");
          }

          if(poruka==''){
               greske.push("Poruka nije u dobrom formatu");
          }

          if(greske.length){
               let ispis='';
               for (let i = 0; i < greske.length; i++) {
                    ispis+=greske[i] + "<br>";
               }
               $("#success").html(ispis);
          }
          else{
               $.ajax({
                    url:"modules/kontaktProvera.php",
                    method:"post",
                    data:{
                         ime:ime,
                         email:email,
                         poruka:poruka,
                         send:true
                    },
                    success:function(data){
                         $("#success").html(data);
                    },
                    error:function(xhr,status,data){
                         alert(xhr.status + status);
                    }
               });
          }
     });

     var flag=false;
     $("#glasanje").click(function(){
          var skriveno =$("#skrivenoOdgovor").val();
          var odgovor=$("input[name='radioAnketa']:checked").val();
          if(!odgovor){
               $("#odgovor").html("Morate uneti vrednost!");
          }else{

               if(!flag){
                    $.ajax({
                         url:"modules/anketa.php",
                         method:"post",
                         dataType:"json",
                         data:{
                              skriveno:skriveno,
                              odgovor:odgovor,
                              send:true
                         },
                         success:function(data){
                              console.log(data)
                              let ispis=`<table class="korpa" border="1"><tr><td>Odgovor</td><td>Broj</td></tr>`;
                              for(let i of data){
                                   ispis+=`<tr>
                                   <td>${i.odgovor}</td><td>${i.broj}</td>
                                   </tr>`
                              }
                              ispis+=`</table>`
                              $("#odgovor").html(ispis);
                         },
                         error:function(xhr,status,data){
                              switch(xhr.status){
                                   case 409:$("#odgovor").html("Vec ste uneli odgovor");break;
                                   default:alert(xhr.status + status);break;
                              }
                              
                         }
                    });
                    flag=true;
               }
               


          }
          
     })

     

}); 

function sviProizvodiUKorpi(){
     return JSON.parse(localStorage.getItem("proizvodi"));
}

function popuniSveProizvode(){
     
     $.ajax({
          url:"modules/proizvodi.php",
          dataType:"json",
          data:{
               id:1,
               idKat:0
          },
          method:"post",
          success:function(data){
               ispisiProizvode(data);
          },
          error:function(xhr,status,data){

               
               alert(xhr.status + status);
                    
          }
     });
}

function ispisiProizvode(data){
     let ispis="";
     for(let proizvod of data){
          ispis+=` <div class="col-xs-12 col-sm-6 col-md-3 service"> <img src="${proizvod.slika}" class="img-responsive" alt="${proizvod.naziv}">
          <h3>${proizvod.naziv}</h3>
          <p>${proizvod.cena},00 din.</p>
         <a href="index.php?page=proizvod&i=${proizvod.idArtikal}" data-id="${proizvod.idArtikal}" class="brn btn-success register detaljnije">DETALJNIJE</a>
           </div>`;
     }
     $("#sviProizvodi").html(ispis);
     $("#paginacija").show();
}

function popuniGaleriju(){

     $.ajax({
          url:"modules/paginacijaGalerija.php",
          dataType:"json",
          method:"post",
          data:{
               id:1,
          },
          success:function(data){
               ispisiGal(data);
          },
          error:function(xhr,status,data){
               alert(xhr.status + status);
          }
     });
}
function ispisiGal(data){
     let ispis="";
     for(let slika of data){
          ispis+=`<div class="col-sm-6 col-md-4 col-lg-3 residential">
          <div class="portfolio-item">
            <div class="hover-bg"> <a href="${slika.slika}" title="${slika.naziv}" data-lightbox="ourgallery">
              <div class="hover-text">
                <h4>${slika.naziv}</h4>
              </div>
              <img src="${slika.slika}" class="img-responsive" alt="${slika.alt}"> </a> </div>
          </div>
        </div>`;
     }
     $("#galerija").html(ispis);
}
function filtrirajPoMarki(id){
     $.ajax({
          url:"modules/sviProizvodi.php",
          dataType:"json",
          method:"post",
          success:function(data){
               data=data.filter(p=>p.idKategorija==id);
               ispisiProizvode(data);
          },
          error:function(xhr,status,data){
               alert(xhr.status + status);
          }
     });
}

function popuniKorpu(){

     
     var proizvodi=sviProizvodiUKorpi();
     
     $.ajax({
          url:"modules/sviProizvodi.php",
          dataType:"json",
          method:"post",
          success:function(data){
               data=data.filter(p=>{
                    for(let proizvod of proizvodi){
                         if(proizvod.id==p.idArtikal){
                              p.kolicina=proizvod.kolicina;
                              return true;
                         }
                    }
                    return false;
               });
               
               napraviTabelu(data);
          },
          error:function(xhr,status,data){
               alert(xhr.status + status);
          }
     });
    

     
}

function napraviTabelu(data){
     let ispis=`<table class="korpa"  border="1">
     <thead>
          <tr>
               <th>Redni broj</th>
               <th>Naziv</th>
               <th>Proizvod</th>
               
               <th>Osnovna cena</th>
               <th>Količina</th>
               <th>Ukupna cena</th>
               <th>Obriši</th>
          </tr>
     </thead>
     <tbody>`;

     let br=1;
     for(let i of data){
          ispis+=`<tr class="rem1">
          <td>${br++}</td>
          <td>${i.naziv}</td>
          <td><img src="${i.slika}" style='width:100px' alt="${i.alt}" class="img-responsive"</td>
          <td>${i.cena}</td>
          <td>${i.kolicina}</td>
          <td>${Number(i.cena)*Number(i.kolicina)}</td>
          <td>
               <a href='#' data-id="${i.idArtikal}" name='link' class='btn btn-primary obrisiKorpu'>Obrisi</a>
          </td>
     </tr>`;
     }
     ispis+=`</tbody>
     </table>`;
     $("#korpa1").html(ispis);
}
function prikaziPaginaciju(id){
     $.ajax({
          url:"modules/paginacija.php",
          dataType:"json",
          data:{
               id:id,
          },
          method:"post",
          success:function(data){
               let ispis=``;
               let broj=data.brojSlika;
               let brojLinkova=Math.ceil(broj/4);
               for(let i=1; i <= brojLinkova; i++){
                    if(i==1){
                         ispis+=`<li class='active'>
                         <a href="#" class="pag" data-id="${i}">
                              ${i}
                         </a>
                    </li>`;
                    }else{
                         ispis+=` <li>
                         <a href="#" class="pag" data-id="${i}">
                              ${i}
                         </a>
                    </li>`;
                    }        
               }
                   
          $("#paginacija2").html(ispis);
            
          },
          error:function(xhr,status,data){
               alert(xhr.status + status);
          }
     });

}

