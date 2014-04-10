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
			  <span id="tituloFormulario">Cuestionario inicial</span>
              <br/><br/>
              <span id="textoFormulario">Para seguir el programa de EnjoyHealth te pedimos de favor que llenes los siguientes campos :</span>
              <br /><br />
			  
                <form id="registerForm" accept-charset="utf-8" action="../controllers/registraCuestionario.php" method="post">
                    <label for="slider">¿Cuánto pesas? (en kilogramos)</label>
                    <input type="number" name="peso" id="peso" pattern="[0-9]*"  value="">   
                    <br /><br />
                    <label for="slider">¿Cuánto mides? (en centimetros)</label>
                    <input type="number" name="estatura" id="estatura" pattern="[0-9]*"  value="">  
                    <br /><br />
                    <label for="slider">¿Cuántos años tienes? </label>
                    <input type="number" name="edad" id="edad" pattern="[0-9]*"  value="">  
                    <br /><br />
                    <label for="slider">¿Qué talla de pantalon eres? </label>
                    <input type="number" name="talla" id="talla" pattern="[0-9]*"  value="">
                    <br /><br />
                    <label for="alergico">¿Eres alérgico a algún alimento?</label>
                    <select name="alergico" id="alergico" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="medicamento">¿Tomas medicamentos de manera cotidiana?</label>
                    <select name="medicamento" id="medicamento" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="diabetes">¿Tienes diabetes?</label>
                    <select name="diabetes" id="diabetes" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="hipotiroidismo">¿Tienes hipotiroidismo?</label>
                    <select name="hipotiroidismo" id="hipotiroidismo" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="colesterol">¿Tienes colesterol elevado?</label>
                    <select name="colesterol" id="colesterol" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />
                    <label for="triglicéridos">¿Tienes triglicéridos altos?</label>
                    <select name="triglicéridos" id="triglicéridos" >
                        <option value="no">No</option>
                        <option value="si" selected="">Si</option>
                    </select>
                    <br /><br />                                                                            
                    <label for="comiendo">¿Qué estás comiendo a grandes rasgos? ¿De manera cotidiana?</label>
                    <input type="text" name="comiendo" id="comiendo" value="">                    
                    <br /><br />
                    <label for="numeroComidas">¿Cuántas comidas puedes hacer al día sin presión?</label>
                    <input type="number" name="numeroComidas" id="numeroComidas" pattern="[0-9]*"  value="">                                        
                    <br /><br />
                    <label for="objetivo">¿Cuál es el objetivo que tienes en mente?</label>
                    <input type="text" name="objetivo" id="objetivo" value="">     
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
