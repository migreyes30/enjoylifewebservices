<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';	

		$token = $_POST['token'];
		//validamos el token recibido.
		if($token == md5($PASSPHRASE)){

	    	header('Content-Type: text/javascript; charset=utf8');
			header('Access-Control-Allow-Origin: *');

			$usuario = $_POST['usuario'];
			$nombre = $_POST['nombre'];
			$email = $_POST['email'];
			$peso = $_POST['peso'];
			$talla = $_POST['talla'];

			// Nos conectamos a la base
	        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
	        // Seleccionamos una base de datos
	        $database = $mongoDB->$DATABASE_NAME;
	        // Seleccionamos una coleccion
	        $clientes = $database->clientes;

			$clientes -> update(  
				array("usuario" => $usuario),
				array('$set' => array(
					"nombre" => $nombre,
					"email" => $email,
					"peso" => (int)$peso,
					"talla" => (int)$talla,
					)
				)
				); 

				header('content-type: application/json; charset=utf-8');
				echo json_encode($usuario);			

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>