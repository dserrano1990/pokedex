<!DOCTYPE HTML>
<html>

<head>
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximun-scale=1.0, minimun-scale=1.0">
	<meta charset='UTF-8'>
	<link href="css/estilo.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https: //code.jquery.com/jquery-3.4.1.slim.min.js
		" integrity=" sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n
		" crossorigin=" anonymous"></script> 
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
		integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
		crossorigin="anonymous"></script> 
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
		integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6"
		crossorigin="anonymous"></script>
</head>

<body>
	<div id="divPrincipal">
		<div class="container" id="divBuscar">
		<img alt="logo" src="img/pokemon.png" id="pokeLogo">
		<h3>PokeDex</h3>
		<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
			<input type="text" name="buscar" id="inputBuscar"><br> 
			<input type="submit" name="submit" value="buscar" id="subBuscar">
		</form>
	</div>
	
	<div class="container" id="divResultado"></div>
	<div class="container" id="h3Nom"></div>
	<div class="container" id="habTip">
		
		<div class="row">
			<div class="col-sm-5" id="hab"></div>
			<div class="col-sm-2"></div>
			<div class="col-sm-5" id="tip"></div>
		</div>
	</div>
	</div>
</body>
<footer>
	<p id="pFotter">© David Serrano 2020</p>
</footer>
</html>

<?php

if (isset($_POST['submit'])) {
    
    $pokemon = strtolower($_POST["buscar"]);
    
    $apiUrl = curl_init("https://pokeapi.co/api/v2/pokemon/$pokemon");
    curl_setopt($apiUrl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($apiUrl);
    curl_close($apiUrl);
    
    $jsonResponse = json_decode($response);
    
    $nom = $jsonResponse->forms[0]->name;
    $tipo = "tipo:<br>".$jsonResponse->types[0]->type->name;
    $habil = "";
    foreach ($jsonResponse->abilities as $key => $value) {
        $habil = $habil. $value->ability->name."<br>";
        
    }
    $habilF = "habilidad:<br>".$habil;
    
    
    /* echo "<h3>NOMBRE</h3>";
    echo $jsonResponse->forms[0]->name;
    
    echo "<h3>HABILIDADES</h3>";
    foreach ($jsonResponse->abilities as $key => $value) {
        echo $value->ability->name."<br>";
    }
    
    echo "<h3>TIPO</h3>";
    echo $jsonResponse->types[0]->type->name; */
    
    $pos = $jsonResponse->id;
    /* echo '<img src="'.$jsonResponse->sprites->back_default.'"width="200">';
     echo '<img src="'.$jsonResponse->sprites->front_default.'"width="200">'; */
   
    $imag = '<img src="https://www.cpokemon.com/pokes/home/'."$pos".'.png">';
    echo "<script>document.getElementById('divResultado').innerHTML = '$imag';</script>";
    echo "<script>document.getElementById('h3Nom').innerHTML = '$nom';</script>";
    echo "<script>document.getElementById('tip').innerHTML = '$tipo';</script>";
    
    echo "<script>document.getElementById('hab').innerHTML = '$habilF';</script>";
    
}else{
    $apiUrl = curl_init("https://pokeapi.co/api/v2/pokemon/charmander");
    curl_setopt($apiUrl, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($apiUrl);
    curl_close($apiUrl);
    
    $jsonResponse = json_decode($response);
    
    $nom = $jsonResponse->forms[0]->name;
    $tipo = "tipo:<br>".$jsonResponse->types[0]->type->name;
    $habil = "";
    foreach ($jsonResponse->abilities as $key => $value) {
        $habil = $habil. $value->ability->name."<br>";
        
    }
    $habilF = "habilidad:<br>".$habil;
    
    
    /* echo "<h3>NOMBRE</h3>";
     echo $jsonResponse->forms[0]->name;
     
     echo "<h3>HABILIDADES</h3>";
     foreach ($jsonResponse->abilities as $key => $value) {
     echo $value->ability->name."<br>";
     }
     
     echo "<h3>TIPO</h3>";
     echo $jsonResponse->types[0]->type->name; */
    
    $pos = $jsonResponse->id;
    /* echo '<img src="'.$jsonResponse->sprites->back_default.'"width="200">';
     echo '<img src="'.$jsonResponse->sprites->front_default.'"width="200">'; */
    
    $imag = '<img src="https://www.cpokemon.com/pokes/home/'."$pos".'.png">';
    echo "<script>document.getElementById('divResultado').innerHTML = '$imag';</script>";
    echo "<script>document.getElementById('h3Nom').innerHTML = '$nom';</script>";
    echo "<script>document.getElementById('tip').innerHTML = '$tipo';</script>";
    
    echo "<script>document.getElementById('hab').innerHTML = '$habilF';</script>";
}



?>