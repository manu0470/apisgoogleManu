<?php 
	
	$buscar = null;
	$latitud = null;
	$longitud = null;
	$formatted_address = null;

	try {
		if (isset($_GET['buscar'])) {
		
		//Aqui ponemos la clave de nuestra key...
		$apiManu = "AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM";

		//Aqui cachamos la key de la api...
		$buscar = urldecode(trim($_GET['buscar']));

		$google = "https://maps.googleapis.com/maps/api/geocode/json?address=" . $buscar . "&key=" . $apiManu;

		$goojson = file_get_contents($google);
		$gooarray = json_decode($goojson, true);

		$latitud = ($gooarray["results"][0]["geometry"]['location']['lat']);
		$longitud = ($gooarray["results"][0]["geometry"]['location']['lng']);
		$formatted_address = ($gooarray["results"][0]["formatted_address"]);
	}
	} catch (Exception $e) {
		
	}


	

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>API GOOGLE MAPS | MANU</title>
	<link rel="stylesheet" href="flatly.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=<?=$apiManu?>" ></script>
	<link rel="icon" style="image/x-icon" href="img/logo.png">
	<link rel="stylesheet" href="css/estilos.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<script src="https://kit.fontawesome.com/a85adf3762.js" crossorigin="anonymous"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM"></script>
	<script src="gmaps.min.js"></script>

	<script type="text/javascript">
		var mapa;
		$(document).ready(function() {
			mapa = new GMaps({
				div : '#mapa',
				lat : <?=$latitud?>,
				lng : <?=$longitud?>,
				zoom : 16,
				mapTypeId: google.maps.MapTypeId.HYBRID
			});

			mapa.addMarker({
				lat: <?=$latitud?>,
				lng: <?=$longitud?>,
				title: '<?=$formatted_address?>',
				infoWindow: {
					content: '<?=$formatted_address?>'
				}
			});

		});
	</script>

	<style>
#search_input {font-size:18px;}
.form-group{
 margin-bottom: 10px;margin-top:50px;
}
.form-group label{
 font-size:18px;
 font-weight: 600;
}
.form-group input{
    width: 100%;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 1px solid #ced4da;
    border-radius: .25rem;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
}
.form-group input:focus {
    color: #495057;
    background-color: #fff;
    border-color: #80bdff;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(0,123,255,.25);
}
</style>
</head>
<body style="background:white;">
	

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#" style="margin: 0 auto;"><img src="img/logoGoogle.png" alt="" width="300" height="50"></a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarNav">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#sec1"><button type="button" class="btn btn-outline-danger"><p style="font-size:15px; margin: 0 auto;">Maps JavaScript API</p></button></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#sec2"><button type="button" class="btn btn-outline-danger"><p style="font-size:15px; margin: 0 auto;">Maps Static API</p></button></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#sec3"><button type="button" class="btn btn-outline-danger"><p style="font-size:15px; margin: 0 auto;">Places API</p></button></a>
					</li>
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#sec4"><button type="button" class="btn btn-outline-danger"><p style="font-size:15px; margin: 0 auto;">Time Zone API</p></button></a>
					</li>
				</ul>
			</div>
		</div>
	</nav>






	<div class="container">

		<div align="center"><img src="img/logogif.gif"></div>
		<br><br><br><br><br><br>

		<section id="sec1" style="background:rgba(250, 2, 10, 0.1); border-radius: 30px;">
			<div class="row">

			<div class="col-md-2"></div>

			<div class="col-md-8" align="center">
				<p style="font-size: 60px; text-align: center;">Maps JavaScript API</p>
				<form class="form-inline" method="get" style="text-align: center;">
					<br>
					<h4>INTRODUCE EL LUGAR A BUSCAR: </h4>
					<i class="fa-solid fa-location-dot" style="font-size:30px; color: red;"></i><br>
					<div class="form-group" align="center">
						<!-- AQUI PONEMOS UN LABEL PARA LA BUSQUEDA DEL LUGAR-->
						<input class="form-control" type="text" name="buscar" id="buscar" value="<?=urldecode($buscar)?>" style="width: 100%;">
					</div><br><br>
					<!-- EN ESTE INPUT NOS CON LA CONEXION A LA API NOS MOSTRARA EL LUGAR UBICADO EN UN MAPA-->
					<input class="btn btn-danger" type="submit" name="submit" value="BUSCAR EN EL MAPA">
					<br><br>
				</form>

				<br><br>

				<div id="mapa" style="width: 100%; height: 400px; border-radius: 20px;"></div>
			</div>

			<div class="col-md-2"></div>


		</div>
		<br><br>
		</section>


		
		<br><br>

		<section id="sec2" style="background:rgba(250, 2, 10, 0.1); border-radius: 30px;">
			<div class="map-container" align="center">
				<p style="font-size: 60px; text-align: center;">Maps Static API</p>
				<img class="maps-static" id="static" src="https://maps.googleapis.com/maps/api/staticmap?center=Brooklyn+Bridge,New+York,NY&zoom=13&size=600x300&maptype=roadmap
				&markers=color:blue%7Clabel:S%7C40.702147,-74.015794&markers=color:green%7Clabel:G%7C40.711614,-74.012318
				&markers=color:red%7Clabel:C%7C40.718217,-79.998284
				&key=AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM" alt="">
			</div>
			<br><br>
		</section>

<br><br>


<section id="sec3" style="background:rgba(250, 2, 10, 0.1); border-radius: 30px;">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-8">
			<p style="font-size: 60px; text-align: center;">Places API</p>
			<div class="form-group">
				<label>Su localización es:</label>
				<input type="text" class="form-control" id="search_input" placeholder="Escribe nombres de lugares que desea consultar" />
			</div>
		</div>
		<div class="col-md-2"></div>
	</div>
	<script>
		var searchInput = 'search_input';

		$(document).ready(function () {
			var autocomplete;
			autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
				types: ['geocode'],
});

			google.maps.event.addListener(autocomplete, 'place_changed', function () {
				var near_place = autocomplete.getPlace();
			});
		});
	</script>
	<br><br>
</section>

<br><br>

<section id="sec4" style="background:rgba(250, 2, 10, 0.1); border-radius: 30px;">
	<div class="row" align="center">
	<div class="col-md-2"></div>
	<div class="col-md-8">
		<p style="font-size: 60px; text-align: center;">Time Zone API</p>
		<br>

		<div class="row">
			<div class="col-md-3">
				<div class="card" style="width: 18rem; border-radius: 20px;">
					<img src="img/usa.jpg" class="card-img-top" alt="..." style="border-radius: 20px;">
					<div class="card-body">
						<h5 class="card-title">ESTADOS UNIDOS</h5>
						<p class="card-text">La Fecha y Hora de Estados Unidos es: <span id="LATime">cargando</span>.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card" style="width: 18rem; border-radius: 20px;">
					<img src="img/mexico.jpg" class="card-img-top" alt="..." style="border-radius: 20px;">
					<div class="card-body">
						<h5 class="card-title">MÉXICO</h5>
						<p class="card-text">La Fecha y Hora de México es: <span id="DCTime">cargando</span>.</p>
					</div>
				</div>
			</div>	
			<div class="col-md-3">
				<div class="card" style="width: 18rem; border-radius: 20px;">
					<img src="img/francia.jpg" class="card-img-top" alt="..." style="border-radius: 20px;">
					<div class="card-body">
						<h5 class="card-title">FRANCIA</h5>
						<p class="card-text">La Fecha y Hora de Francia es: <span id="FRTime">cargando</span>.</p>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="card" style="width: 18rem; border-radius: 20px;">
					<img src="img/china.jpg" class="card-img-top" alt="..." style="border-radius: 20px;">
					<div class="card-body">
						<h5 class="card-title">CHINA</h5>
						<p class="card-text">La Fecha y Hora de China es: <span id="CHTime">cargando</span>.</p>
					</div>
				</div>
			</div>


		</div>
		
		<script src="http://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="js/remoteTime.js"></script>
		<script>
			$("#LATime").remoteTime({
				key: "AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM",
				location: "New Jersey, USA",
				format: "m/d/y g:i:s a"
			});
			
			$("#DCTime").remoteTime({
				key: "AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM",
				location: "México City",
				format: "m/d/y g:i:s a"
			});
			$("#FRTime").remoteTime({
				key: "AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM",
				location: "Londres, Francia",
				format: "m/d/y g:i:s a"
			});
			
			$("#CHTime").remoteTime({
				key: "AIzaSyC_UwaejdWAO71-91WxZN6xkuxWkDo8GyM",
				location: "Shanghai, China",
				format: "m/d/y g:i:s a"
			});
		</script>
	</div>
	<div class="col-md-2"></div>
</div>
<br><br>
</section>


	</div><!--FIN DEL CONTAINER-->
	<script src="bootstrap.min.js"></script>

<br><br><br><br>

</body>
</html>