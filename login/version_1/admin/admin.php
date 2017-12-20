<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
 
    <title>TSIberia</title>
	<link rel="icon" href="../images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="../main.css" />
	<script type="text/javascript" src="../js/link.js"></script>
	
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
			include '../index.php';
		}else{	
			//Averiguamos el Nombre y Apellidos del usario
			$result = mysqli_query($conexion, "SELECT name, surname, permit FROM Users WHERE user='$login'");
			$row = mysqli_fetch_row($result);
			$name = $row[0];
			$surname = $row[1];
			$permit = $row[2];
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
					echo "&nbsp;&nbsp;&nbsp;<acronym title='Salir'><a href='../logout.php'><img src='../images/BotonSalir.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='25' HEIGHT='25'></a></acronym>";
					?></h2>
				</div>
				<div id="logo">
					<img  src="../images/logo.png" border="0" alt="Logo TSI" />
				</div>
			</div>
			<div id="menu-bar2" align="center">
				<table cellspacing="0" cellpadding="0" border="0" width="100%" align="center">
					<tr>
						<?php 
						if ($permit == 2){
							echo "<td><a href=../dias.php?user=$login_encode>PETICI&Oacute;N D&Iacute;AS LIBRES</a></td>";
							echo "<td><a href=../sugerencias.php?user=$login_encode>SUGERENCIAS/PREGUNTAS</a></td>";
						}else if($permit == 3){
							echo "<td><a href=./select.php?user=$login_encode>GESTI&Oacute;N VACACIONES EMPLEADOS</a></td>";
						}else if($permit == 4){
							echo "<td><a href=../dias.php?user=$login_encode>PETICI&Oacute;N D&Iacute;AS LIBRES</a></td>";
							echo "<td><a href=../sugerencias.php?user=$login_encode>SUGERENCIAS/PREGUNTAS</a></td>";
							echo "<td><a href=./select.php?user=$login_encode>GESTI&Oacute;N VACACIONES EMPLEADOS</a></td>";
						}else if($permit == 5){
							echo "<td><a href=../dias.php?user=$login_encode>PETICI&Oacute;N D&Iacute;AS LIBRES</a></td>";
							echo "<td><a href=../sugerencias.php?user=$login_encode>SUGERENCIAS/PREGUNTAS</a></td>";
						}else if($permit == 6){
							
						}
						?>
					</tr>
				</table>
			</div>
			<div id="content">
				<div id="sub-menu">
					<?php echo 'Bienvenido/a, <b>'.$name.'</b>.';?>
				</div>
				<div id="front-page">
					<p><h1>PORTAL ADMINISTRADOR</h1><br>
					A trav&eacute;s de esta plataforma podr&aacute; gestionar todas las peticiones de dias libres de toda la plantilla de TSI.<br>
					<b>Para empezar seleccione la opci&oacute;n del men&uacute; superior.</b><br><br>

					<br><img  src="../images/administrator.png" border="0" alt="Logo Administrator" />
					</p>
				</div><!-- front-page -->
			</div><!-- content -->
			<?php
		}    
	}else{
		//Header("Location: index.php");
		include '../index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html>
