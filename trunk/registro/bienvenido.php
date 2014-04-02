<?php
        
        if (!empty($_GET["nombre"])){
            $nombre = $_GET["nombre"];
        }else{
            $nombre = "";
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

</head>
<body>
	<div id="container">
		<div id="contenido" >
			<br /><br /> <br /><br /> 
			<h1>
				Estimado <?php echo $nombre; ?>
			</h1>
			<span> Bienvenido a EnjoyHealth, para continuar con el proceso recibirás un correo de nosotros explicandote los pasos a seguir, por favor espera. </span>
            <br /><br />   		

		</div>

	</div>

</body>
</html>