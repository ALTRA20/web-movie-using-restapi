<?= $this->extend('templates/dashboard'); ?>
<?= $this->section('content'); ?>
<style> a{ color: black; text-decoration: none; } </style>
<nav class="navbar navbar-expand-lg bg-light">
  <div class="container-fluid d-flex justify-content-between">
    <a class="navbar-brand" href="#">Navbar</a>
    <section>
	    <input class="form-control me-2" id="search" type="search" 
      placeholder="Masukan kata kunci film" aria-label="Search" style="width: 700px;">
    </section>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
    \ aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse flex-grow-0" id="navbarSupportedContent" style="width:fit-content;">
      <ul class="navbar-nav mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Link</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Dropdown
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Action</a></li>
            <li><a class="dropdown-item" href="#">Another action</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Something else here</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link disabled">Disabled</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div id="result"> 
</div>
<div class="row" id="content" style="">
</div>
<script type="text/javascript" src="/js/jquery.js"></script>
<script>
  $.getJSON( "/film/show", function(data) {
  let listFilm= data;
let arr =[];
for (i in listFilm) {
 arr.push([ listFilm[i].id,listFilm[i].judul, listFilm[i].sampul, listFilm[i].genre, listFilm[i].actor, 
  listFilm[i].negara, listFilm[i].sutradara, listFilm[i].storyline, listFilm[i].tahunTerbit], );
}
listFilm.sort(function (a, b) {
  return new Date(b.tahunTerbit) - new Date(a.tahunTerbit);
})
    let content = '';
      $.each(listFilm, function(i, data){
        // console.log(data.judul);
        if (data.status === "0") {
          $('#content').append(`<div class="d-flex flex-column justify-content-between mx-auto" 
            style="background:url('/img/`+data.sampul+`'); background-size:cover; background-repeat:no-repeat; 
            height: 250px; width: 180px; box-sizing: border-box; padding-left:0px;"><div></div><span 
            class="d-flex align-items-center justify-content-center text-center px-2" style="height:85px; 
            background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)); width:180px;"><a href="/film/`+data.slug+`" 
            class="my-3" style="color:white;">`+data.judul+`</a></span></div>`);
        }else{
          $('#content').append(`<div class="d-flex flex-column justify-content-between mx-auto" 
            style="background:url('/img/`+data.sampul+`'); background-size:cover; background-repeat:no-repeat; 
            height: 250px; width: 180px; box-sizing: border-box;padding-left:0px;"><div></div><span class="d-flex 
            flex-column align-items-center justify-content-center text-center pt-2" style="height:93px; 
            background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)); width:180px;"><a href="/film/`+data.slug+`" 
            class="" style="display:inline-block;height:70%;color:white;"><p style="vertical-align: text-bottom; margin:0;">
            `+data.judul+`</p></a><b style="display:inline-block;height:70%;color:yellow;letter-spacing: 1px;">Premium</b></span></div>`);
        }
      })
});

//search ajax
$(document).ready(function(){
 $.ajaxSetup({ cache: false });
 $('#search').keyup(function(){
  $('#result').html('');
  $('#state').val('');
  var searchField = $('#search').val();
  var expression = new RegExp(searchField, "i");
  $.getJSON('/data.json', function(datas) {
    let data = datas.data
   $.each(data, function(key, value){
      // console.log(value);
      if (value.judul.search(expression) != -1 || value.actor.search(expression) != -1)
      {
        console.log(value.judul);
       $('#result').append(`<li class="list-group-item link-class"><a href="/film/`+value.id+`" style="display:inline-block; width:100%"><img src="`+value.sampul+`" height="40" width="40" class="img-thumbnail" /> `+value.judul+` | <span class="text-muted">`+value.actor+`</span></a></li>`);
      }
   });   
  });
 });
});
<?= $this->endSection(); ?>