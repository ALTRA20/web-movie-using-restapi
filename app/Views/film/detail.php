<?= $this->extend('templates/dashboard'); ?>
<?= $this->section('content'); ?>
<style>
	body{ background-color: grey; }
	p{ margin-bottom: 0; margin-top: 0; }
	.card{ font-size: 17px; }
	#subCard{color: red; }
	#card-small p{ font-size: 15px; }
</style>
<section class="row">
	<div class="col-8">
		<div id="content1">
			<section class="row">
				<div class=" bg-white px-5">
					<h2> <?= $listFilm['judul'] ?> </h2>
					<hr class="">
					<div class="card mb-3 border-0" style="">
						<div class="row g-0">
							<div class="col-md-4">
								<img src="/img/<?= $listFilm['sampul'] ?>" class="img-fluid rounded-start" alt="...">
							</div>
							<div class="col-md-8">
								<div class="card-body" style="font-size: 18px;">
									<p class="card-text">Genre : <span class="text-danger"> <?= $listFilm['genre'] ?> </span></p>
									<p class="card-text">Actor : <span class="text-danger"> <?= $listFilm['actor'] ?> </span></p>
									<p class="card-text">Sutradara : <span class="text-danger"> <?= $listFilm['sutradara'] ?> </span></p>
									<p class="card-text">Negara : <span class="text-danger"> <?= $listFilm['negara'] ?> </span></p>
									<p class="card-text">Rating : <span class="text-danger"> <?= $rate ?> </span></p>
									<p class="card-text">Alur Cerita : <span class="text-danger">` <?= $listFilm['storyline'] ?> </span></p>
									<a href="/" class="btn btn-warning">Kembali</a>
								</div>
						</div>
					</div>
				</div>
				</div>
			</section>
		</div>
		<div>
			<section class="bg-white row px-5" id="content2">
				<h3>Terbaru</h3>

			</section>
		</div>
	</div>
	<div class="col-4 p-3 border border-dark border-top-0 border-bottom-0 border-end-0" style="background:white; height:100%;">
		<h3>Terpopuler</h3>
		<div id="main"></div>
		<div>
			<a href="" class="btn btn-success"><<</a>
			<a href="" class="btn btn-success">1</a>
			<a href="" class="btn btn-success">2</a>
			<a href="" class="btn btn-success">3</a>
			<a href="" class="btn btn-success">4</a>
			<a href="" class="btn btn-success">>></a>
		</div>
	</div>
</section>
<script type="text/javascript" src="/js/jquery.js"></script>
<script>
 $.getJSON( "/data.json", function(data) {
  let listFilm= data.data;
	listFilm.sort(function (a, b) {
	// console.log(new Date(b.tahunTerbit) - new Date(a.tahunTerbit));
	  // console.log(listFilm);
	  return b.rate - a.rate;
	});
    let content = '';
      $.each(listFilm, function(i, data){
        // console.log(data.judul);
     		 $('#main').append(`<div id="content" class="card"><section class="d-flex"><img src="/img/`+data.sampul+`" class="" alt="..." style="height: 100px; width: 80px;"><div class="ms-2" style=""><h4 style="font-weight: bold;"> `+data.judul+` </h4><p>Genre : <span id="subCard"> `+data.judul+` </span></p><p>Rateing : <span id="subCard">`+data.rate+`</span></p></div></section></div><hr class="my-1 border border-dark" style="width: 100%;">`)
      });
	data.data.sort(function (a, b) {
	// console.log(new Date(b.tahunTerbit) - new Date(a.tahunTerbit));
	  // console.log(listFilm);
	  return new Date(b.tahunTerbit) - new Date(a.tahunTerbit);
	});
      $.each(listFilm, function(i, data){
        // console.log(data.judul);
     		 $('#content2').append(`<div class="d-flex flex-column justify-content-between align-items-center me-2 mb-2" style="background:url('/img/`+data.sampul+`'); background-position: center; background-size: cover; width: 120px; height:180px;"><div></div><div class="d-flex justify-content-center align-items-center" id="card-small" style="background:linear-gradient(rgba(0,0,0,.6),rgba(0,0,0,.6)); width:120px; height:50px"><p style="color: white;">ggggggg</p></div></div>`)
      });
});
</script>
<?= $this->endSection(); ?>
