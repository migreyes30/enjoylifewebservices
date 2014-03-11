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

			// Nos conectamos a la base
	        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
	        // Seleccionamos una base de datos
	        $database = $mongoDB->$DATABASE_NAME;
	        // Seleccionamos una coleccion
	        $clientes = $database->clientes;
	        
			$query = array('usuario' =>  $usuario);

			$isActive = array('email' =>  1,'nombre' =>  1);

	        $result = $clientes->find($query,$isActive);
	        $email = "";
	        $name = "";
	        $array = iterator_to_array($result);

	        if(count($array) > 0){

			foreach ($result as $obj) {
				$email = $obj['email'];
			   	$name = $obj['nombre'];				
			   	$posts[] = array(
			   		"email" => $obj['email'],
			   	);
			}

			error_log($usuario. " " . $email,0);

			sendRecoverPasswordEmail($usuario,$email,$name);

			$success = array('response' => $posts);
			/* output in necessary format */
				header('content-type: application/json; charset=utf-8');
				echo json_encode($success);

	        }else{

	        	echo "error";
	        }

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>