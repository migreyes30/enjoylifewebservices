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
			$password = $_POST['password'];

			// Nos conectamos a la base
	        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
	        // Seleccionamos una base de datos
	        $database = $mongoDB->$DATABASE_NAME;
	        // Seleccionamos una coleccion
	        $clientes = $database->clientes;

	        //db.clientes.find( { usuario : 'migue030' },{usuario : 1 ,password : 1} )
	        
			$query = array('usuario' =>  $usuario);
			$isActive = array(
								"usuario" => 1,
								"password" => 1
							);

	        $result = $clientes->find($query,$isActive);

	        $array = iterator_to_array($result);


	        //array with message of not loggin possible
	        $noLogin =	array(  
							'logged' => false,  
							'message' => 'Usuario y/o contraseña incorrectas'  
						);

	        if(count($array) > 0){
	        	//If array > 0 user exist

	        	foreach ($result as $obj) {
		        	$userInDB=$obj['usuario'];
		        	$pwdInDB=$obj['password'];
		        	$idInDB=$obj['_id'];
		        }

		        if($pwdInDB == md5($password) and $userInDB == $usuario){
		        	
					$response = array(  
					        'logged' => true,  
					        'userInDB' => $userInDB,  
					        'idInDB' => $idInDB 
					    );  

		        	setcookie("userId", $idInDB);

					echo json_encode($response);
		        	//$_COOKIE;
		        }else{
		        	echo json_encode($noLogin);
		        }

	        }else{
	        	//If array < 0 user doesnt exist
	        	echo json_encode($noLogin);
	        }

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>