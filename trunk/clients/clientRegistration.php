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

			$usuario = $_POST['usuario'];
			$nombre = $_POST['nombre'];
			$password = $_POST['password'];
			$email = $_POST['email'];
			$peso = $_POST['peso'];
			$talla = $_POST['talla'];

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
								"email" => $email,
								"fechaRegistro" => $fecha,
								"historialPeso" => array(
														array(
															"fecha" => $fecha,
															"peso" => (int)$peso
														)
													),
								"peso" => (int)$peso,
								"historialTalla" => array(
														array(
															"fecha" => $fecha,
															"talla" => (int)$talla
														)
													),
								"talla" => (int)$talla
							);

	        	$clientes -> insert($newClient);
	        }

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>