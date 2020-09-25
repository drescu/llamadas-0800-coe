<?php

$dni = $_POST["dni"];
$sexo = 1;

//......................... usando curl ............................

// url solicitando token
$url_token = "https://federador.msal.gob.ar/masterfile-federacion-service/api/usuarios/aplicacion/login";
	
// parametros de autorizacion
$param_token = array(
 	"nombre" => "HQgdGgMcFxMaCl4SEh8FDFwNEksCCBwZEUYCABAAAw==",
 	"clave" => "RgwLQFRJASxAEEQOJiMjPkY=",
 	"codDominio" => "2.16.840.1.113883.2.10.58"
);
	
//creamos el json a partir de nuestro arreglo
$param_json = json_encode($param_token);

// inicializamos la libreria cURL
$ch_token = curl_init();

// indicamos la URL
curl_setopt( $ch_token, CURLOPT_URL, $url_token );	

// indicamos que utilizaremos POST
curl_setopt( $ch_token, CURLOPT_POST, true );

//Adjuntamos el json a nuestra petición
curl_setopt( $ch_token, CURLOPT_POSTFIELDS, $param_json );

//para que la peticion no imprima el resultado como un echo comun, y podamos manipularlo
curl_setopt( $ch_token, CURLOPT_RETURNTRANSFER, 1 );

//Agregamos los encabezados del contenido
curl_setopt($ch_token, CURLOPT_HTTPHEADER,array('Content-Type: application/json'));

//ignorar el certificado, servidor de desarrollo
curl_setopt($ch_token,CURLOPT_SSL_VERIFYHOST, FALSE);

// ejecutamos la peticion
$res_token = curl_exec( $ch_token );
	
// verificamos si hay error
if ($res_token == FALSE) { 
	die(curl_error($ch_token));
}
	
$info_token = json_decode($res_token);
	
$token = $info_token->token;
		
curl_close($ch_token);
	

// comienza el get 		
do {
		
	$headers_request =  array(
		"Content-Type: application/json",
		"token: $token",
		"codDominio: 2.16.840.1.113883.2.10.58"
	);

	$url_request = "https://federador.msal.gob.ar/masterfile-federacion-service/api/personas/renaper?nroDocumento=$dni&idSexo=$sexo";
		
	$ch_request = curl_init();

	curl_setopt( $ch_request, CURLOPT_RETURNTRANSFER, 1 );

	curl_setopt( $ch_request, CURLOPT_URL, $url_request );

	curl_setopt($ch_request, CURLOPT_HTTPHEADER, $headers_request);

	curl_setopt($ch_request, CURLOPT_SSL_VERIFYPEER, FALSE);

	curl_setopt($ch_request,CURLOPT_SSL_VERIFYHOST, FALSE);

	$res_request = curl_exec($ch_request);	

	if ($res_request === FALSE) {
		die(curl_error($ch_request));
	}
	
	//$info_request = json_decode($res_request);
	
	if( $res_request ) {
		$estado = "con_info";
	}
	else {
		$estado = "sin_info";
		$sexo = $sexo + 1;
	}
	
} while ($estado == "sin_info" and $sexo < 3); 
	
curl_close($ch_request);

// devuelve el objeto que trae del renaper con todos los datos
	echo $res_request;

	



//............................. fin curl .......................   

?>	
