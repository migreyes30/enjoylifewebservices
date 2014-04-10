<?php
        
        if (!empty($_GET["error"])){
            $error_message = "Error : El usuario ya existe en la base datos";
        }else{
            $error_message = "";
        }


        $usuario = base64_decode($_GET['ue']);

        $name = base64_decode($_GET['uname']);

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
                        peso: {
                            required: true,
                            number: true,
                            maxlength: 3
                        },
                        talla: {
                            required: true,
                            number: true,
                            maxlength: 2
                        },
                        estatura: {
                            required: true,
                            number: true,
                            maxlength: 2
                        },
                        edad: {
                            required: true,
                            number: true,
                            maxlength: 2
                        },
                        password2 : {
                            required: true,
                            equalTo : "#password"
                        },
                        email: {
                            required: true,
                            email: true
                        },

                   },
                    messages: {
                            peso: {
                                number: "Peso invalido, solamente numeros",
                                required : "Campo requerido",
                                maxlength : "Peso Invalido, no mayor a 3 digitos"
                            },
                            talla: {
                                required : "Campo requerido",
                                number : "Talla invalido, solamente numeros",
                                maxlength: "Talla Invalido, no mayor a 2 digitos"
                            },
                            estatura: {
                                required : "Campo requerido",
                                number : "Talla invalido, solamente numeros",
                                maxlength: "Talla Invalido, no mayor a 2 digitos"
                            },
                            edad: {
                                required : "Campo requerido",
                                number : "Talla invalido, solamente numeros",
                                maxlength: "Talla Invalido, no mayor a 2 digitos"
                            },
                            estatura: {
                                required : "Campo requerido"
                            },
                            password2: {
                                required : "Campo requerido",
                                equalTo : "No coinciden los passwords"
                            },              
                            email: {
                                required : "Campo requerido",
                                email : "Email no valido"
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
			  <span id="tituloFormulario">Cuestionario semanal</span>
              <br/><br/>
              <span id="textoFormulario">Hola <?php echo $name; ?>, para seguir el programa de EnjoyHealth te pedimos de favor que llenes los siguientes campos :</span>
              <br /><br />

                <form id="registerForm" accept-charset="utf-8" action="../controllers/registraCuestionarioSemanal.php" method="post">
                    <input type="hidden" name="usuario" id="usuario" value='<?php echo $usuario; ?>' >
                    <input type="hidden" name="name" id="name" value='<?php echo $name; ?>' >
                    <input type="hidden" name="semanaActual" id="semanaActual" value='1' >
                    <label for="diasDieta">¿Cuántos días de la semana hizo la dieta?</label>
                    <input type="number" name="diasDieta" id="diasDieta" pattern="[0-9]*" id="number-pattern" value="">                                        
                    <br /><br /> 
                    <label for="slider">¿Cuánto pesas? (en kilogramos)</label>
                    <input type="number" name="peso" id="peso" pattern="[0-9]*"  value="">   
                    <br /><br />
                    <label for="slider">¿Qué talla de pantalon eres? </label>
                    <input type="number" name="talla" id="talla" pattern="[0-9]*"  value="">
                    <br /><br />               
                    <label for="evidentePesoTalla">¿Fue más evidente en el peso que en la talla?</label>
                    <select name="evidentePesoTalla" id="evidentePesoTalla" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br /> 
                   <label for="reaccion">¿Hubo alguna reacción en los alimentos permitidos?</label>
                    <select name="reaccion" id="reaccion" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br /> 
                    <label for="extrenimiento">¿Hubo extreñimiento?</label>
                    <select name="extrenimiento" id="extrenimiento" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br /> 
                    <label for="decaido">¿Te sentiste decaído?</label>
                    <select name="decaido" id="decaido">
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br /> 
                    <label for="problemasDormir">¿Tuviste problemas para dormir?</label>
                    <select name="problemasDormir" id="problemasDormir" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br /> 
                    <label for="experiencia">En general cuál fue tu experiencia esta semana?</label>
                    <input type="text" name="experiencia" id="experiencia" value="">
                    <br /><br /> 
                    <input type="submit" value="Enviar" id="submitButton" class="botonEnviarCuestionario"/>
                </form>    









			</div>
			<br/>
		</div>
    <div class="push"></div>
        
    </div>
<!-- end #container -->
</body>
</html>
