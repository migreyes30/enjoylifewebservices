<?php
		global $DATABASE_HOSTNAME;
		global $DATABASE_NAME;
		global $DATABASE_PORT;
		global $DATABASE_USER;
		global $DATABASE_PASS;
		global $PASSPHRASE;
		require_once '../config/variables.php';
		include '../email/notificacionesEmail.php';

		$usuario = $_POST['usuario'];
		$name = $_POST['name'];
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
		
		$hayError = false;
		$mensajeError = "";
		
		// Nos conectamos a la base
        $mongoDB = new Mongo('mongodb://'.$DATABASE_HOSTNAME.':'.$DATABASE_PORT);
        // Seleccionamos una base de datos
        $database = $mongoDB->$DATABASE_NAME;
        // Seleccionamos una coleccion
        $clientes = $database->clientes;



		$queryChecaSemana = array('usuario' =>  $usuario,'ultimaSemanaCuestionario' => (int)$semana);
        $resultChecaSemana = $clientes->find($queryChecaSemana);
        $arrayChecaSemana = iterator_to_array($resultChecaSemana);

		$queryChecaUsuario = array('usuario' =>  $usuario);
        $resultChecaUsuario = $clientes->find($queryChecaUsuario);
        $arrayChecaUsuario = iterator_to_array($resultChecaUsuario);

        if(count($arrayChecaSemana) > 0){
        	// el cuestionario de esta semana ya se contestó
        	$hayError = true;
        	$mensajeError = "Error: El cuestionario de esta semana ya ha sido contestado.";
        }else{
        	if(count($arrayChecaUsuario) <= 0){
        		//el usuario no existe en la base de datos
        		$hayError = true;
        		$mensajeError = "Error : El usuario que está intentando contestar el cuestionario no existe en la base de datos.";
        	}else{
				$query = array('usuario' =>  $usuario);

				$fecha = new MongoDate();

		    	$newData = array('$set' => array(
								"peso" => (int)$peso,
								"talla" => (int)$talla,
								"ultimaSemanaCuestionario" => (int)$semana
							));

		    	$newDataPush = array('$push' => array(
								"historialPeso" => array(
															"fecha" => $fecha,
															"peso" => (int)$peso
													),
								"historialTalla" => array(
															"fecha" => $fecha,
															"talla" => (int)$talla
													),
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

		        $clientes -> update($query,$newDataPush,array("upsert" => false,"multiple" => false));


        	}


        }


        $mongoDB->close();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Enjoy Health - Cuestionario Semanal</title>
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
			<img src="../img/logo.png"  style="width:300px;height:250px;"/>
			<h1>
				Estimado <?php echo $name; ?>
			</h1>
			<span style="font-size:18px;">
				<?php if($hayError){
					echo $mensajeError;
				}else{
					echo "Tu cuestionario ha sido enviado, en breve recibirás un nuevo plan.";
				} ?>
			</span>
			<br /><br />
			<span style="font-size:18px;"> Saludos, <br /> EnjoyHealth </span>		
		</div>

	</div>

</body>
</html>