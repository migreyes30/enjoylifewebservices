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
		$pesoRegistrado = false;

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

			if(count($arregloHashtags[1]) > 0 ) { //funciones especiales de hashtags
				foreach ($arregloHashtags[1] as &$value) {
						switch ($value)
						{
						case 'peso':
						  $pesoRegistrado = registraPeso($message,$user,$db);
						  break;
						case 'talla':
						  registraTalla($message,$user,$db);
						  break;
						case 'hashtag':
						  echo "";
						  break;
						}
				}	
			}


			if(count($arregloHashtags[1]) > 0 && count($arregloDestinatarios[1]) > 0){
				$documentoMensaje = array(
					"mensaje" => $message,
					"remitente" => $user,
					"fecha" => $fecha,
					"hashtags" => $arregloHashtags[1],
					"destinatarios" => $arregloDestinatarios[1],
					"registroPeso" => $pesoRegistrado
				);
	
			}elseif (count($arregloHashtags[1]) > 0 && count($arregloDestinatarios[1]) == 0) {
				$documentoMensaje = array(
					"mensaje" => $message,
					"remitente" => $user,
					"fecha" => $fecha,
					"hashtags" => $arregloHashtags[1],
					"registroPeso" => $pesoRegistrado
				);
			}elseif (count($arregloHashtags[1]) == 0 && count($arregloDestinatarios[1]) > 0) {
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
			$m->close();
			/* output in necessary format */
				header('content-type: application/json; charset=utf-8');
				echo json_encode($message);

		}else{
			echo "Invalid Token";
			error_log("Error invalid token  " , 0);
		}


		function registraPeso($mensaje,$usuario,$db){
			error_log("hola aa" ,0);
			$posicionPeso = strrpos($mensaje, "peso");
			$tamanoMensaje = strlen($mensaje);

			preg_match_all('!\d+!', substr($mensaje, $posicionPeso, $tamanoMensaje ) , $matches);

			if(count($matches[0])>0 ){
				$peso = $matches[0][0];

				if($peso > 30 && $peso < 200 ){

					// Seleccionamos una coleccion
					$clientes = $db->clientes;

					$clientes -> update(  
						array("usuario" => $usuario),
						array('$push' => array(
							"historialPeso" => array(
								"fecha" => new MongoDate(),
								"peso" => (int)$peso
								)
							)
						)
						); 

					$clientes -> update(  
						array("usuario" => $usuario),
						array('$set' => array(
							"peso" => (int)$peso
							)
						)
						); 
					return true;
				}else{
					return false;
				}

			}else{
				return false;
			}
			
		}


		function registraTalla($mensaje,$usuario,$db){

			$posicionPeso = strrpos($mensaje, "talla");
			$tamanoMensaje = strlen($mensaje);

			preg_match_all('!\d+!', substr($mensaje, $posicionPeso, $tamanoMensaje ) , $matches);

			if(count($matches[0])>0 ){
				$talla = $matches[0][0];

				if($talla >= 0 && $talla < 200 ){

					// Seleccionamos una coleccion
					$clientes = $db->clientes;

					$clientes -> update(  
						array("usuario" => $usuario),
						array('$push' => array(
							"historialTalla" => array(
								"fecha" => new MongoDate(),
								"talla" => (int)$talla
								)
							)
						)
						); 

					$clientes -> update(  
						array("usuario" => $usuario),
						array('$set' => array(
							"talla" => (int)$talla
							)
						)
						); 

				}



			}
			
		}		

?>