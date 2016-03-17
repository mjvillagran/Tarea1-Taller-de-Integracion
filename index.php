<?php
if ("$_SERVER[REQUEST_URI]" == "/index.php/validarFirma") {
	if($_POST["hash"]==null || $_POST["mensaje"] == null  || hash ("sha256" ,$_POST["mensaje"]) == null){
		http_response_code(400);
		echo "Parametros incorrectos";
	}
	else{
		http_response_code(200);
		echo "mensaje: ". json_encode($_POST["mensaje"]);
		
		if ($_POST["hash"] == hash ("sha256" ,$_POST["mensaje"])){
			echo "\nvalido: ". json_encode(true);
		}
		else{
			echo "\nvalido: ". json_encode(false);
	}
	}
}
if ("$_SERVER[REQUEST_URI]" == "/index.php/status") {
	http_response_code(201);
	echo json_encode("Status: ok");
}

if ("$_SERVER[REQUEST_URI]" == "/index.php/texto") {
	echo "Texto: ". file_get_contents("https://s3.amazonaws.com/files.principal/texto.txt");
	echo "\nHash: ". hash ("sha256" ,file_get_contents("https://s3.amazonaws.com/files.principal/texto.txt"));
}
?>
