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
        $userInDB = "";
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
        }else{
        	header("location:../clients/recuperaPassword.php?");
        }

        $mongoDB->close();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Enjoy Health - Password actualizado</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
	<meta name="Keywords" content="Enjoy Health"/>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"> </script>	

</head>
<body>
	<div id="container">
		<div id="contenido" style="height:630px;">
			<h1>
				Estimado <?php echo $name; ?>
			</h1>
			<span> Tu password ha sido cambiado, ahora podrás logearte con tu nuevo password en la aplicación. </span>		

		</div>

	</div>

</body>
</html>