<?php
if ("$_SERVER[REQUEST_URI]" == "/index.php/validarFirma") {
	if($_POST["hash"]==null || $_POST["mensaje"] == null){
		http_response_code(400);
		echo "Parametros incorrectos";
	}
	elseif ( hash ("sha256" ,$_POST["mensaje"]) == null){
		http_response_code(500);
		echo "error de servidor";
	}
	else{
		if (strtolower ($_POST["hash"]) == strtolower ( hash ("sha256" ,$_POST["mensaje"]))){
			$arr = array('mensaje' => $_POST["mensaje"], 'valido' => true);
			echo json_encode($arr);
			http_response_code(200);
		}
		else{
			$arr = array('mensaje' => $_POST["mensaje"], 'valido' => false);
			echo json_encode($arr);
			http_response_code(200);
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
