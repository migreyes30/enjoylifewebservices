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

    	header('Content-Type: text/javascript; charset=utf8');
		header('Access-Control-Allow-Origin: *');

		$usuario = $_POST['usuario'];
		$nombre = $_POST['nombre'];
		$masculino = $_POST['masculino'];
		$email = $_POST['email'];
		$genero = $_POST['genero'];

		error_log("nuevo registro web" . $usuario . " " . $nombre . " " . $genero,0);

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

        if($genero == "male"){
        	$genero = "M";
        }else{
        	$genero = "F";
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
        	sendNewWebRegisterNotification($usuario,$email,$nombre);
        	error_log("registro web completado",0);
        }

        $mongoDB->close();
        header("location: ../registro/bienvenido.php");
?>