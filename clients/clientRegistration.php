<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';	
		include '../email/notificacionesEmail.php';

		$token = $_POST['token'];
		//validamos el token recibido.
		if($token == md5($PASSPHRASE)){

	    	header('Content-Type: text/javascript; charset=utf8');
			header('Access-Control-Allow-Origin: *');

			$usuario = $_POST['usuario'];
			$nombre = $_POST['nombre'];
			$masculino = $_POST['masculino'];
			$femenino = $_POST['femenino'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$genero = $_POST['genero'];


			// Nos conectamos a la base
	        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
	        // Seleccionamos una base de datos
	        $database = $mongoDB->$DATABASE_NAME;
	        // Seleccionamos una coleccion
	        $clientes = $database->clientes;
	        
			$query = array('usuario' =>  $usuario);
			$isActive = array('usuario' =>  1);

	        $result = $clientes->find($query,$isActive);

	        $array = iterator_to_array($result);

	        if($genero == "on"){
	        	$genero = "F";
	        }else{
	        	$genero = "M";
	        }

	        if(count($array) > 0){

	        	foreach ($result as $obj) {
		        	$userInDB=$obj['usuario'];
		        }

		        echo ($userInDB);

	        }else{

				$fecha = new MongoDate();

	        	$newClient = array(
								"usuario" => $usuario,
								"nombre" => $nombre,
								"password" => md5($password),
								"genero" => $genero,
								"email" => $email,
								"fechaRegistro" => $fecha,
								"activo" => 1
							);

	        	$clientes -> insert($newClient);
	        	sendActivationEmail($usuario,$email,$nombre);
	        }

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>