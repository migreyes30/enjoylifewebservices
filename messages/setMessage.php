<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';	

		$user = $_POST['user'];
		$message = $_POST['mensaje'];
		$token = $_POST['token'];
		
		error_log("Error " . $_POST['mensaje'] . " " , 0);

		$fecha = new MongoDate();
		//validamos el token recibido.
		if($token == md5($PASSPHRASE)){

			// Nos conectamos a la base
			$m = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);

			// Seleccionamos una base de datos
			$db = $m->$DATABASE_NAME;

			// Seleccionamos una coleccion
			$mensajes = $db->mensajes;


			preg_match_all('/#(\w+)/',$message,$arregloHashtags);
			preg_match_all('/@(\w+)/',$message,$arregloDestinatarios);

			if(count($arregloHashtags) > 0 && count($arregloDestinatarios) > 0){
				$documentoMensaje = array(
					"mensaje" => $message,
					"remitente" => $user,
					"fecha" => $fecha,
					"hashtags" => $arregloHashtags[1],
					"destinatarios" => $arregloDestinatarios[1]
				);
	
			}elseif (count($arregloHashtags) > 0 && count($arregloHashtags) == 0) {
				$documentoMensaje = array(
					"mensaje" => $message,
					"remitente" => $user,
					"fecha" => $fecha,
					"hashtags" => $arregloHashtags[1]
				);
			}elseif (count($arregloHashtags) == 0 && count($arregloHashtags) > 0) {
				$documentoMensaje = array(
					"mensaje" => $message,
					"remitente" => $user,
					"fecha" => $fecha,
					"destinatarios" => $arregloDestinatarios[1]
				);
			}else{
				$documentoMensaje = array(
					"mensaje" => $message,
					"fecha" => $fecha,
					"remitente" => $user
				);				
			}
			

			$mensajes->insert($documentoMensaje);

			/* output in necessary format */
				header('content-type: application/json; charset=utf-8');
				echo json_encode($message);

		}else{
			echo "Invalid Token";
			error_log("Error invalid token  " , 0);
		}

?>