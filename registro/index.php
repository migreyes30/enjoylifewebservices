<?php
        
        if (!empty($_GET["error"])){
            $error_message = "Error : El usuario ya existe en la base datos";
        }else{
            $error_message = "";
        }
?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>EnjoyHealth :: Registro</title>
	<meta http-equiv="content-type" content="text/html;charset=UTF-8" /> 
	<link href="../css/style.css" rel="stylesheet" type="text/css" media="screen"/>
    <script type="text/javascript" src="../js/jquery-1.8.0.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"> </script>
    
  <script type="text/javascript">
        $(function() {
           $( "#registerForm" ).validate({
                   rules: {
                        usuario: {
                            required: true
                        },
                        nombre: {
                            required: true
                        },
                        password: {
                            required: true,
                            minlength: 6
                        },
                        password2 : {
                            required: true,
                            equalTo : "#password"
                        },
                        email: {
                            required: true,
                            email: true
                        },
                        peso: {
                            required: true,
                            number: true,
                            maxlength: 3
                        },
                        talla: {
                            required: true,
                            number: true,
                            maxlength: 2
                        }
                   },
                    messages: {
                            usuario: {
                                required : "Campo requerido"
                            },
                            nombre: {
                                required : "Campo requerido"
                            },
                            password: {
                                required : "Campo requerido",
                                minlength : "Al menos 8 catacteres"
                            },
                            password2: {
                                required : "Campo requerido",
                                equalTo : "No coinciden los passwords"
                            },              
                            email: {
                                required : "Campo requerido",
                                email : "Email no valido"
                            },
                            peso: {
                                number: "Peso invalido, solamente numeros",
                                required : "Campo requerido",
                                maxlength : "Peso Invalido, no mayor a 3 digitos"
                            },
                            talla: {
                                required : "Campo requerido",
                                number : "Talla invalido, solamente numeros",
                                maxlength: "Talla Invalido, no mayor a 2 digitos"
                            }
                    }                   
           });
		   

    });        
    </script>
</head>
<body>
<!-- begin #container -->
    <div id="container">
        <div id="contenido">
            <img src="../img/logo.png"  style="width:300px;height:250px;"/>
			<div id="formulario">
			  <span id="tituloFormulario">Registro</span>
              <br/><br/>
              <span id="textoFormulario">Para registrarte en enjoyhealth te pedimos de favor que llenes los siguientes campos :</span>
              
			  <form id="registerForm" accept-charset="utf-8" action="../controllers/registra.php" method="post">
			  <br/>

                    <br/>
                    <input type="text" name="usuario" id="usuario" placeholder="Usuario" class="inputText">
                    <label id="userMsg" class="userMsg"></label>
                    <br/><br/>
                    <input type="text" name="nombre" id="nombre" placeholder="Nombre Completo" class="inputText">
                    <br/>

                    <br />
                    <label for="genero">Genero</label>
                    <br />
                    <input type="radio" name="genero" value="male" class="inputText"> <span class="elementoRadio">Masculino</span> <br />
                    <input type="radio" name="genero" value="female" class="inputText"> <span class="elementoRadio">Femenino</span>                 
                    <br />                  
                    <br/>
                    <input type="password" name="password" id="password" placeholder="Password"  class="inputText">
                    <br/><br/>
                    <input type="password" name="password2" id="password2" placeholder="Inserta tu password nuevamente" class="inputText">
                    <br/><br/>
                    <input type="email" name="email" id="email" placeholder="Correo electrónico" data-clear-btn="true" class="inputText">

                    <br /><br/>

                    <?php
                            
                        echo "<span id='mensajeError'>". $error_message ."</span><br/>";
                            
                    ?>

                    <br/>
				    <input type="submit" value="Crear cuenta" id="submitButton" class="botonEnviarFormulario"/>
			  </form>

			</div>
			<br/>
		</div>
    <div class="push"></div>
        
    </div>
<!-- end #container -->
</body>
</html>
