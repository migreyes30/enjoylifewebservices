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
			$semana = $_POST['semanaActual'];
			$diasDieta = $_POST['diasDieta'];
			$peso = $_POST['peso'];
			$talla = $_POST['talla'];
			$evidentePesoTalla = $_POST['evidentePesoTalla'];
			$reaccion = $_POST['reaccion'];
			$extrenimiento = $_POST['extrenimiento'];
			$decaido = $_POST['decaido'];
			$problemasDormir = $_POST['problemasDormir'];
			$experiencia = $_POST['experiencia'];

			
			// Nos conectamos a la base
	        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
	        // Seleccionamos una base de datos
	        $database = $mongoDB->$DATABASE_NAME;
	        // Seleccionamos una coleccion
	        $clientes = $database->clientes;
	        
			$query = array('usuario' =>  $usuario);

				$fecha = new MongoDate();

	        	$newData = array('$set' => array(
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
								"talla" => (int)$talla,
								"resultadosCuestionarioSemanal" => array(
										"semana" => (int)$semana,
										"peso" => (int)$peso,
										"talla" => (int)$talla,
										"diasDieta" => (int)$diasDieta,
										"evidentePesoTalla" => $evidentePesoTalla,
										"reaccion" => $reaccion,
										"extrenimiento" => $extrenimiento,
										"decaido" => $decaido,
										"problemasDormir" => $problemasDormir,
										"experiencia" => $experiencia
									)
							));

	        	$clientes -> update($query,$newData,array("upsert" => false,"multiple" => false));


	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>