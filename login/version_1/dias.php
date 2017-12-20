<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
    <title>TSIberia</title>
	<link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./main.css" />
    <link rel="stylesheet" type="text/css" href="./css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="./css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="./css/steel/steel.css" />
    <script type="text/javascript" src="./js/jscal2.js"></script>
    <script type="text/javascript" src="./js/lang/es.js"></script>
	<script type="text/javascript" src="./js/link.js"></script>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
	
</head>
<body>
<?php
	//declaro las funciones que desencripta la variable GET
	function decode($string)
	{
	$string = base64_decode($string); //decodifico la cadena
	$control = "qwerty"; //defino la llave con la que fue encriptada la cadena,, cambiarla por la que deseamos usar
	$string = str_replace($control, "", "$string"); //quito la llave de la cadena
	return($string);
	}
	function encode($string) 
	{
	$string = utf8_encode($string);
	$control = "qwerty"; //defino la llave para encriptar la cadena, cambiarla por la que deseamos usar
	$string = $control.$string.$control; //concateno la llave para encriptar la cadena
	$string = base64_encode($string);//codifico la cadena
	return($string);
	} 

	//conectamos bbdd
    $conexion = mysqli_connect("db523240012.db.1and1.com","dbo523240012","TSiberia17","db523240012");       
	if (isset($_GET["user"])){
		//Ingreso exitoso, ahora sera dirigido a la pagina principal.
		$id = $_GET["user"];	
		$login = decode($id);
		// Comprobamos si el login de usuario existe
        $checklogin = mysqli_query($conexion, "SELECT user FROM Users WHERE user='$login'");
        $login_exist = mysqli_num_rows($checklogin);    
        if ($login_exist==0) {
			echo "<font color='red'>'El usuario no existe'</font>";
			include 'index.php';
		}else{	
			//Averiguamos el Nombre y Apellidos del usario
			$result = mysqli_query($conexion, "SELECT name, surname FROM Users WHERE user='$login'");
			$row = mysqli_fetch_row($result);
			$name = $row[0];
			$surname = $row[1];
			$name = strtoupper($name);
			$login = strtoupper($login);		
			?>
			<div id="top-bar" align="center">
							<div id="bar-option">
								<h2><?php
								// Establecer la zona horaria predeterminada a usar. Disponible desde PHP 5.1
								date_default_timezone_set('UTC');
								//Imprimimos la fecha actual dandole un formato
								echo date("d-m-Y");?><BR><BR><?php
								$login_encode = encode($login);
								echo "&nbsp;&nbsp;&nbsp;<acronym title='Opciones'><a href=./opciones.php?user=$login_encode><img src='./images/opciones.png' BORDER=0 ALIGN='bottom' ALT='OPCIONES' WIDTH='25' HEIGHT='25'></a></acronym>&nbsp;&nbsp;<acronym title='Salir'><a href='./logout.php'><img src='./images/BotonSalir.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='25' HEIGHT='25'></a></acronym>";
							
								?></h2>
							
							</div>
							<div id="logo">
								<img  src="./images/logo.png" border="0" alt="Logo TSI" />
							</div>
						</div>
						<div id="menu-bar" align="center">
							<table cellspacing="0" cellpadding="0" border="0" width="100%" align="center">
									<tr>
										<?php 
										echo "<td><a href=./dias.php?user=$login_encode>PETICI&Oacute;N D&Iacute;AS LIBRES</a></td>";
										echo "<td><a href=./sugerencias.php?user=$login_encode>SUGERENCIAS/PREGUNTAS</a></td>";?>
									</tr>
							</table>
						</div>
						<div id="content">
						<div id="sub-menu">
						<?php
							echo 'Bienvenido/a, <b>'.$name.'</b>.';
							?>
							</div>
				<div id="front-page">
					<h1>PETICI&Oacute;N D&Iacute;AS LIBRES</h1>
						<p>
						Dispone de dos modalidades para la petici&oacute;n de d&iacute;as libres.<BR>A su izquierda si quiere pedir un intervalo de m&aacute;s de 15 d&iacute;as seguidos y su derecha si quiere pedir d&iacute;as sueltos contiguos o alternos, siempre un n&uacute;mero menor a 15 d&iacute;as.
						<table cellpadding='10'>
							<tr>
								<td VALIGN="TOP">
						<?php													
							echo "<form name='form_interval' method='POST' action='./rdias.php'>
									<BR><BR><b>- Intervalo de fechas (Min. 15 d&iacute;as)</b><BR><BR>
									
									<label for='f_rangeStart'>De </label>
									<input type='text' size='15' id='f_rangeStart_20' name='start_date' readonly='readonly'>
									<img src='./images/cal.png' id='f_rangeStart_trigger_20' ALT='cal' WIDTH='25' HEIGHT='20' />
									
									<label for='f_rangeStart'>&nbsp;Hasta </label>
									<input type='text' size='15' id='f_rangeStart_21' name='end_date' readonly='readonly'>
									<img src='./images/cal.png' id='f_rangeStart_trigger_21' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
									<input type='hidden' name='user' value='$id'>
									
				
									<input type='submit' name='submit' value='Enviar petici&oacute;n'></form>
									<button id='f_clearRangeStart_2' onclick='clearRangeStart_2()'>Limpiar</button>";
							?>
						<script type="text/javascript">
							var DISABLED_DATES = {
								20140501: true,
								20140714: true,
								20140716: true,
								20140815: true,
								20141009: true,
								20141208: true,
								20141225: true,
								
								20140503: true,
								20140504: true,
								20140510: true,
								20140511: true,
								20140517: true,
								20140518: true,
								20140524: true,
								20140525: true,
								20140531: true,
								
								20140601: true,
								20140607: true,
								20140608: true,
								20140614: true,
								20140615: true,
								20140621: true,
								20140622: true,
								20140628: true,
								20140629: true,
								
								20140705: true,
								20140706: true,
								20140712: true,
								20140713: true,
								20140719: true,
								20140720: true,
								20140726: true,
								20140727: true,
								
								20140802: true,
								20140803: true,
								20140809: true,
								20140810: true,
								20140816: true,
								20140817: true,
								20140823: true,
								20140824: true,
								20140830: true,
								20140831: true,
								
								20140906: true,
								20140907: true,
								20140913: true,
								20140914: true,
								20140920: true,
								20140921: true,
								20140927: true,
								20140928: true,
								
								20141004: true,
								20141005: true,
								20141011: true,
								20141012: true,
								20141018: true,
								20141019: true,
								20141025: true,
								20141026: true,
								
								20141101: true,
								20141102: true,
								20141108: true,
								20141109: true,
								20141115: true,
								20141116: true,
								20141122: true,
								20141123: true,
								20141129: true,
								20141130: true,
								
								20141206: true,
								20141207: true,
								20141213: true,
								20141214: true,
								20141220: true,
								20141221: true,
								20141227: true,
								20141228: true
							};
							RANGE_CAL_20 = new Calendar({
								disabled : function(date) {
									date = Calendar.dateToInt(date);
									return date in DISABLED_DATES;
								},
								min: 20140601,
								max: 20141231,
								inputField: "f_rangeStart_20",
								dateFormat: "%d/%m/%Y",
								trigger: "f_rangeStart_trigger_20",
								bottomBar: false,									 
								onSelect   : function() { this.hide() }
							});
							RANGE_CAL_21 = new Calendar({
								disabled : function(date) {
									date = Calendar.dateToInt(date);
									return date in DISABLED_DATES;
								},
								min: 20140601,
								max: 20141231,
								inputField: "f_rangeStart_21",
								dateFormat: "%d/%m/%Y",
								trigger: "f_rangeStart_trigger_21",
								bottomBar: false,									 
								onSelect   : function() { this.hide() }
							});
							function clearRangeStart_2() {
								document.getElementById("f_rangeStart_20").value = "";
								document.getElementById("f_rangeStart_21").value = "";
								LEFT_CAL.args.min = null;
								LEFT_CAL.redraw();
							};
						</script>
						</td>
						<td VALIGN="TOP" width="150" ALIGN="center"><img src='./images/linea4.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='330'></td>
						<td VALIGN="TOP">
						<?php
						echo "<form name='form' method='POST'>
								<BR><BR><b>- D&iacute;as libres sueltos a solicitar:</b><BR><BR>
								Cantidad: 
								<select name='dias'>
									<option selected value='1'>1</option>
									<option value='2'>2</option>
									<option value='3'>3</option>
									<option value='4'>4</option>
									<option value='5'>5</option>
									<option value='6'>6</option>
									<option value='7'>7</option>
									<option value='8'>8</option>
									<option value='9'>9</option>
									<option value='10'>10</option>
									<option value='11'>11</option>
									<option value='12'>12</option>
									<option value='13'>13</option>
									<option value='14'>14</option>
									<option value='15'>15</option>
								</select>
								<input type='button' id='btn_enviar' value='Mostrar'>
							</form>";
						?><div id="respuesta"></div>
						
						
						<!--Script codigo Jquery  --> 
						<script>
							$(function(){
							 $("#btn_enviar").click(function(){
							 var url = "./cal.php?user=<?php echo $id; ?>"; // El script a dónde se realizará la petición.
								$.ajax({
									   type: "POST",
									   url: url,
									   data: $("select[name=dias]").serialize(),  // Adjuntar los campos del formulario enviado.
									   success: function(data)
									   {
										   $("#respuesta").html(data); // Mostrar la respuestas del script PHP.
									   }
									 });
								return false; // Evitar ejecutar el submit del formulario.
							 });
							});
						</script>
					</td>
					</tr>
					</table>
					</p>
				</div><!-- front-page -->
			</div><!-- content -->
			<?php
		}    
	}else{
		//Header("Location: index.php");
		include './index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html>
