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
						<?php echo "<td><a href=./select.php?user=$login_encode>GESTI&Oacute;N VACACIONES EMPLEADOS</a></td>";?>
					</tr>
				</table>
			</div>
			<div id="content">
				<div id="sub-menu">
					<?php echo 'Bienvenido/a, <b>'.$name.'</b>.';?>
				</div>
				<div id="front-page">
					<p><h1>GESTI&Oacute;N VACACIONES EMPLEADOS</h1><br>
					Avisos:<?php
					
					/*if($permit == 4){
						//Consulta averiguar si hay alguna petición pendiente de resulver y de que usuarios es.
						$result = mysqli_query($conexion, "SELECT a.status, b.name, b.surname AS id_user FROM Days AS a LEFT JOIN Users AS b ON a.id_user = b.id_user WHERE a.status = '0' AND b.admin='0' GROUP BY b.name, b.surname");
						$Nombre=array();
						$Apellidos=array();
						while($row=mysqli_fetch_row($result)){	 
							$Nombre[] = $row[1];
							$Apellidos[] = $row[2];
						}
						if ($Nombre == NULL){
							echo " <font color='green'>NO TIENES PETICIONES PENDIENTES</font><BR> ";
						}else{
							echo " <font color='red'>TIENE PETICIONES POR RESOLVER</font><BR>(De: ";
							for($i=0; $i<count($Nombre); $i++){
								echo " <b>".$Nombre[$i]." ".$Apellidos[$i].".</b>";
							}
							?>)<?php
						}
						
					}*/
					if($permit == 4){
						//Consulta averiguar si hay alguna petición pendiente de resulver, y a que usuarios es
						$result = mysqli_query($conexion, "SELECT a.status, b.name, b.surname AS id_user FROM Days AS a LEFT JOIN Users AS b ON a.id_user = b.id_user WHERE a.status = '0' AND b.admin='1' GROUP BY b.name, b.surname");
						$Nombre=array();
						$Apellidos=array();
						while($row=mysqli_fetch_row($result)){	 
							$Nombre[] = $row[1];
							$Apellidos[] = $row[2];
						}
						if ($Nombre == NULL){
							echo " <font color='green'>NO TIENES PETICIONES PENDIENTES</font><BR> ";
						}else{
							echo " <font color='red'>TIENE PETICIONES POR RESOLVER</font><BR>(De: ";
							for($i=0; $i<count($Nombre); $i++){
								echo " <b>".$Nombre[$i]." ".$Apellidos[$i].".</b>";
							}
							?>)<?php
						}
						
					}
					?>	 
					<br>
					<?php
					if($permit == 4){
						// Consulta a BD
						$query = "SELECT id_user, name, surname, admin FROM Users WHERE admin='1' ORDER BY surname, name";
						$result = mysqli_query($conexion,$query) or die(mysqli_error());
						echo "<form name='form' method='POST' action='./admin_resumen.php'>
						<BR><BR><BR><b>-Seleccione trabajador:</b><BR>
						Nombre: 
						<select name='employees'>";
						mysqli_data_seek($result, 0);
						while ($row=mysqli_fetch_row($result)){
							echo "<option value='$row[0]'>$row[2], $row[1]";
						}
					}elseif($permit == 3){
						// Consulta a BD
						$query = "SELECT id_user, name, surname, admin FROM Users WHERE admin='1' ORDER BY surname, name";
						$result = mysqli_query($conexion,$query) or die(mysqli_error());
						echo "<form name='form' method='POST' action='./admin_resumen.php'>
						<BR><BR><BR><b>-Seleccione trabajador:</b><BR>
						Nombre: 
						<select name='employees'>";
						mysqli_data_seek($result, 0);
						while ($row=mysqli_fetch_row($result)){
							echo "<option value='$row[0]'>$row[2], $row[1]";
						}
					}
					
					?>						
					</select>
					<?php echo "<input type='hidden' name='login' value='$login'>
					<input type='submit' name='submit' value='Enviar' />";?>
					</form>
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

