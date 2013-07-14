<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';	

		$token = $_POST['token'];
		
		//error_log("Error " . $_POST['token'] . " " , 0);

		//validamos el token recibido.
		if($token == md5($PASSPHRASE)){

			echo "Registrado";

		}else{
			echo "Invalid Token";
			error_log("Error invalid token  " , 0);
		}

?>