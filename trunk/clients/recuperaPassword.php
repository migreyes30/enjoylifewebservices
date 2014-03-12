<?php
		$usuario = base64_decode($_GET['ui']);
		$token = $_GET['token'];

		$error

		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';
		include '../email/notificacionesEmail.php';

		//validamos el token recibido.
		if($token == md5($PASSPHRASE)){

			
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


			foreach ($result as $obj) {
				$email = $obj['email'];
			   	$name = $obj['nombre'];				
			}

	        $mongoDB->close();

		}else{
			echo "Token Invalido";
			error_log("Error Token Invalido " , 0);
		}

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Enjoy Health - Recupera tu password</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
	<meta name="Keywords" content="Enjoy Health"/>
	<link rel="shortcut icon" href="images/favicon.ico" />
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"> </script>	
<script type="text/javascript">
        $(function() {
           $( "#registerForm" ).validate({
                   rules: {
                        passwordActual: {
                            required: true,
                            maxlength: 20,
                            minlength: 6
                        },
                        passwordNuevo: {
                            required: true,
                            maxlength: 20,
                            minlength: 6
                        },                        
                        passwordNuevo2: {
                            equalTo: "#passwordNuevo"
                        }
                   },
                    messages: {
                        password: {
                            required: "Provide a password",
                            rangelength: jQuery.format("Enter at least {0} characters")
                        },
                        passwordNuevo: {
                            required: "Provide a password",
                            rangelength: jQuery.format("Enter at least {0} characters")
                        },                        
                        passwordNuevo2: {
                            required: "Repeat your password",
                            minlength: jQuery.format("Enter at least {0} characters"),
                            equalTo: "Enter the same password as above"
                        }
                    }                   
           });
    });        
    </script>
</head>
<body>
	<div id="container">
		<div id="contenido" style="height:630px;">
			<h1>
				Estimado <?php echo $name; ?>
			</h1>
			<span> Por favor llena los siguientes campos para cambiar tu password </span>
            <br /><br />   
            <form id="registerForm" accept-charset="utf-8" action="../controllers/setNewPassword.php" method="post">
            	<input type="hidden" name="usuario" id="usuario" value='<?php echo $usuario; ?>' >
                <input type="password" name="passwordActual" id="passwordActual" placeholder="Password Actual" >
                <br /><br />
                <input type="password" name="passwordNuevo" id="passwordNuevo" placeholder="Password nuevo" >
                <br /><br />
                <input type="password" name="passwordNuevo2" id="passwordNuevo2" placeholder="Password nuevo" >
                <br /><br />
				<input type="submit" value="Cambiar password" id="submitButton" class="botonEnviarFormulario"/>
            </form>			

		</div>

	</div>

</body>
</html>