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
                            maxlength: 5,
                            min:20
                        },
                        diasDieta: {
                            required: true,
                            number: true,
                            maxlength: 2,
                            min:0
                        },
                        experiencia: {
                            required: true
                        },
                        edad: {
                            required: true,
                            number: true,
                            maxlength: 2
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
                                maxlength : "Peso Invalido, no mayor a 4 digitos",
                                min : "peso invalido"
                            },
                            diasDieta: {
                                required : "Campo requerido",
                                number : "Días invalidos, solamente numeros",
                                maxlength: "Días invalidos, no mayor a 2 digitos",
                                min:"Número de días invalidos"
                            },
                            experiencia: {
                                required : "Campo requerido"
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
                    <input type="hidden" name="semanaActual" id="semanaActual" value='2' >
                    <label for="diasDieta">¿Cuántos días de la semana hizo la dieta?</label>
                    <input type="number" name="diasDieta" id="diasDieta" pattern="[0-9]*" id="number-pattern" value="">                                        
                    <br /><br /> 
                    <label for="slider">¿Cuánto pesas? (ej 58.5)</label>
                    <input type="number" name="peso" id="peso" pattern="[0-9]*"  value="">   
                    <br /><br />  
                    <label for="slider">¿Cuál fue tu peso anterior? (ej 58.5)</label>
                    <input type="number" name="pesoAnterior" id="pesoAnterior" pattern="[0-9]*"  value="">   
                    <br /><br />                               
                    <label for="evidentePesoTalla">Cómo fue el comportamiento de tu peso?</label>
                    <select name="comportamientoPeso" id="comportamientoPeso" >
                        <option value="subio">Subió</option>
                        <option value="bajo" selected="">Bajó</option>
                        <option value="mantuvo" selected="">Se mantuvo</option>
                    </select>
                    <br /><br /> 
                    <label for="evidentePesoTalla">Cómo fue el comportamiento de tu talla?</label>
                    <select name="comportamientoTalla" id="comportamientoTalla" >
                        <option value="subio">Subió</option>
                        <option value="bajo" selected="">Bajó</option>
                        <option value="mantuvo" selected="">Se mantuvo</option>
                    </select>
                    <br /><br /> 
                   <label for="reaccion">¿Hubo alguna reacción en los alimentos permitidos?</label>
                    <select name="reaccion" id="reaccion" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="estrenimiento">¿Hubo estreñimiento?</label>
                    <select name="estrenimiento" id="estrenimiento" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="extrenimiento">¿En caso de estreñimiento, cuantos días se presentó?</label>
                    <select name="diasEstrenimiento" id="estrenimiento" >
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
                    <label for="problemasDormirCausa">¿El problema para dormir fue a causa de?</label>
                    <select name="problemasDormirCausa" id="problemasDormirCausa" >
                        <option value="consiliarSueno">Consiliar el sueño</option>
                        <option value="despertarNoche" selected="">Despertar en la noche</option>
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
