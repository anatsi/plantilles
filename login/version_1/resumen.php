<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
 
    <title>TSIberia</title>
	<link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./main.css" />
	<script type="text/javascript" src="./js/link.js"></script>
	
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
			$result = mysqli_query($conexion, "SELECT name, surname, id_user FROM Users WHERE user='$login'");
			$row = mysqli_fetch_row($result);
			$name = $row[0];
			$surname = $row[1];
			$id_user = $row[2];
			$name = strtoupper($name);
			$surname = strtoupper($surname);
			$login = strtoupper($login);
			$year14 = 0;
						
			//Averiguamos dias aceptados para el trabajador en el año 2014
			$result = mysqli_query($conexion, "SELECT date FROM Days WHERE id_user='$id_user' AND year='2014'");
			while($row=mysqli_fetch_row($result)){
				$year14 = $year14 +1;
			}
			
			//Averiguamos resumen días libres por trabajador
			$result = mysqli_query($conexion, "SELECT request_day, date, status, year FROM Days WHERE id_user='$id_user'");
			$Fechas_pendientes=array();
			$Fechas_rechazadas=array();
			$Fechas_aceptadas=array();
			$Fechas_Rpendientes=array();
			$Fechas_Rrechazadas=array();
			$Fechas_Raceptadas=array();
			$year_apply=array();
			while($row=mysqli_fetch_row($result)){
				//Convertimos las dos fechas a formato EUROPEO
				$data2 = $row[0];
				$ano2 = substr($data2,0,4);
				$mes2 = substr($data2,5,2);
				$dia2 = substr($data2,8,2);
				$date2 = $dia2 . "/" . $mes2 . "/" . $ano2;
			
				$data = $row[1];
				$ano = substr($data,0,4);
				$mes = substr($data,5,2);
				$dia = substr($data,8,2);
				$date = $dia . "/" . $mes . "/" . $ano;
				 
				if($row[2]==0){
					$Fechas_pendientes[] = $date ;
					$Fechas_Rpendientes[] = $date2;
				}elseif($row[2]==1){
					$Fechas_rechazadas[] = $date ;
					$Fechas_Rrechazadas[] = $date2;
				}else{
					$Fechas_aceptadas[] = $date ;				
					$Fechas_Raceptadas[] = $date2;
					$year_apply[] = $row[3];
				}
			}//Fin averiguar resumen días
		
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
					<h1>RESUMEN D&Iacute;AS LIBRES</h1>
					<p></br>
					<p style="text-align: center;"><b><font size='4oem' color='#2D801C'>LE RESTAN POR DISFUTRAR </font></b><font size='4oem'><?php echo 30-$year14." d&iacute;as del a&ntilde;o 2014"; ?></font></br>
					<b><font size='4oem' color='#2D801C'>TOTAL D&Iacute;AS LIBRES CONCEDIDOS A&Ntilde;O 2014: </font></b><font size='4oem'><?php echo $year14." de 30"; ?></font></br>
					<b><font size='4oem' color='#F45644'>TOTAL D&Iacute;AS RECHAZADOS: </font></b><font size='4oem'><?php echo count($Fechas_rechazadas)?></font></br>
					<b><font size='4oem' color='#CFC91B'>TOTAL D&Iacute;AS PENDIENTES: </font></b><font size='4oem'><?php echo count($Fechas_pendientes)?></font></br></p></br>
						<?php
										
			echo"<div class='datagrid'>
			<h3 align='center'>PENDIENTES DE APROBACI&Oacute;N</h3><BR>
				<table>
					<thead><tr><th>Petici&oacute;n</th><th>D&iacute;a</th></tr></thead>
					
					<tbody>";
					
						for($i=0; $i<count($Fechas_pendientes); $i++){
							echo "<tr class='alt'><td>".$Fechas_Rpendientes[$i]."</td><td><b>".$Fechas_pendientes[$i]."</b></td></tr>";
						}
					echo "</tbody>
				</table>
			</div>
			<div class='datagrid2'>
			<h3 align='center'>RECHAZADOS</h3><BR>
				<table>
					<thead><tr><th>Petici&oacute;n</th><th>D&iacute;a</th></tr></thead>
					
					<tbody>";
						for($i=0; $i<count($Fechas_rechazadas); $i++){
								echo "<tr class='alt'><td>".$Fechas_Rrechazadas[$i]."</td><td><b>".$Fechas_rechazadas[$i]."</b></td></tr>";
						}
					echo "</tbody>
				</table>
			</div>
			<div class='datagrid3'>
			<h3 align='center'>ACEPTADOS</h3><BR>
				<table>
										<thead><tr><th>Petici&oacute;n</th><th>A&ntilde;o aplicable</th><th>D&iacute;a</th></tr></thead>
					
					<tbody>";
						for($i=0; $i<count($Fechas_aceptadas); $i++){
									echo "<tr class='alt'><td>".$Fechas_Raceptadas[$i]."</td><td>".$year_apply[$i]."</td><td><b>".$Fechas_aceptadas[$i]."</b></td></tr>";
						}
					echo "</tbody>
				</table>
			</div>";			
						?>
					</p>
				</div><!-- front-page -->
			</div><!-- content -->
			<?php
		}    
	}else{
		include './index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html>
