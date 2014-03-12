<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';
		include '../email/notificacionesEmail.php';

		$passwordActual = $_POST['passwordActual'];
		$usuario = $_POST['usuario'];
		$passwordNuevo = $_POST['passwordNuevo'];

		//validamos el token recibido.

		

		// Nos conectamos a la base
        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
        // Seleccionamos una base de datos
        $database = $mongoDB->$DATABASE_NAME;
        // Seleccionamos una coleccion
        $clientes = $database->clientes;
        
		$query = array('usuario' =>  $usuario);

		$isActive = array('usuario' =>  1,'password' =>  1);

        $result = $clientes->find($query,$isActive);
        $pwdInDB = "";
        $userInDB = "":
        $array = iterator_to_array($result);

    	foreach ($result as $obj) {
        	$pwdInDB=$obj['password'];
        	$userInDB = $obj['usuario'];
        }

        if($pwdInDB == md5($passwordActual) and $userInDB == $usuario){
        	//el password actual es correcto
			$clientes -> update(  
				array("usuario" => $usuario),
				array('$set' => array(
					"password" => md5($passwordNuevo)
					)
				)
				); 

        	//sendRecoverPasswordEmail($usuario,$email,$name);
        }

        $mongoDB->close();

?>