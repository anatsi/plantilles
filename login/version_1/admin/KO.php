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
	if (isset($_POST["login"])){
		/* Capturo del dato del empleado a mostrar */
		$id_user = $_POST["id_user"];
		$login = $_POST["login"];
		$name = $_POST["name"];
		$surname = $_POST["surname"];
		$cont_fechas = $_POST["cont_fechas"];
		//Estado Rechazado
		$z = 0;


		// Comprobamos si el login de usuario existe
        $checklogin = mysqli_query($conexion, "SELECT id_user FROM Users WHERE id_user='$id_user'");
        $login_exist = mysqli_num_rows($checklogin);
        if ($login_exist==0) {
			echo "<font color='red'>'El usuario no existe'</font>";
			include '../index.php';
		}else{	
			//Averiguamos resumen días libres por trabajador
			$result = mysqli_query($conexion, "SELECT request_day, date, status FROM Days WHERE id_user='$id_user'");
			$Fechas_pendientes=array();
			$Fechas_Rpendientes=array();
			$Fechas_execute=array();
	
			while($row=mysqli_fetch_row($result)){
				//Convertimos las dos fechas a formato EUROPEO
				if($row[2]==0){
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
				
					$Fechas_pendientes[] = $date;
					$Fechas_Rpendientes[] = $date2;
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
										<?php $login_encode = encode($login);
										echo "<td><a href=./admin/select.php?user=$login_encode>GESTI&Oacute;N VACACIONES EMPLEADOS</a></td>";?>
									</tr>
							</table>
						</div>
						<div id="content">
						<div id="sub-menu">
						<?php
							echo 'Bienvenido/a, <b>'.$login.'</b>.';
							?>
							</div>
				<div id="front-page">
					<h1><?php echo 'Empleado: '. $name.' '.$surname; ?></h1>
					<p>
						<p style="text-align: center;"><b><font size='2oem' color='black'>D&iacute;as a rechazar: </b><BR>
							<?php
							//Capturar checkbox de fechas activados por administrador para aceptar 
							for($i=0; $i<$cont_fechas; $i++){
								if(isset($_POST["$i"])){
									if($_POST["$i"] == 'on'){
									$Fechas_execute[] = $Fechas_Rpendientes[$i];
									}
								}
							}
							echo "<BR>";
							
							//ERROR AL NO SELECCIONAR NINGUNA FECHA
							if (count($Fechas_execute) == NULL){
								echo "<font color='red'>'ERRROR. Debe seleccionar alguna fecha pendiente'</font>			
								<form name='formulario1' method='POST' action='admin_resumen.php'>
									<p style='text-align: center;'>
									<input type='hidden' name='login' value='$login'>
									<input type='hidden' name='employees' value='$id_user'>
									<input type='submit' name='submit' value='VOLVER ATRAS' />
									</p>
								</form>";
								
							//MOSTRAR FECHAS ELEGIDAS PENDIENTES PARA APROBAR
							}else{
								?></font><font size=3oem>
								<?php for($i=0; $i<count($Fechas_execute); $i++){
									if ($i==5){
										echo "<BR>";
									}
									elseif ($i==10){
										echo "<BR>";							
									}
									elseif ($i==15){
										echo "<BR>";							
									}
									elseif ($i==20){
										echo "<BR>";							
									}
									elseif ($i==25){
										echo "<BR>";							
									}
									echo $Fechas_execute[$i].",&nbsp; &nbsp;";
								}?></font></br>
								</br>
							
								<?php
								function array_envia($Fechas_execute) 
								{
									$tmp = serialize($Fechas_execute);
									$tmp = urlencode($tmp);   
									return $tmp;
								}//fin funcion
								$Fechas_execute=array_envia($Fechas_execute); 
								echo "<form name='formulario2' method='POST' >
									<fieldset id='form2'>
										<ol>
											<li><label>Elija el motivo del rechazo.</label><BR>
											<input type='radio' name='opcion' onclick='text.disabled = true' value='0' checked='checked'>Aumento producci&oacute;n<BR>
											<input type='radio' name='opcion' onclick='text.disabled = true' value='1'>Falta de personal<BR>
											<input type='radio' name='opcion' onclick='text.disabled = true' value='2'>D&iacute;as ya solicitados<BR>
											<input type='radio' name='opcion' onclick='text.disabled = true' value='3'>Negociable<BR>
											<input type='radio' name='opcion' onclick='text.disabled = false' value='4'>Otros<BR><BR>
											<textarea name='text' rows='5' cols='60' disabled='disabled' ></textarea></li>
										</ul>";
										?>
										<p align='center'><input type="submit" name='submit2' class='btr' onclick = "this.form.action = './admin_resumen.php'" value="VOLVER ATRAS" >
										<input type="submit" name="submit" class="btg" onclick = "this.form.action = './sent.php'" value="ENVIAR"></p>
										<?php
										echo "<input type='hidden' name='login' value='$login'>
										<input type='hidden' name='employees' value='$id_user'>
										<input type='hidden' name='id_user' value='$id_user'>
										<input type='hidden' name='name' value='$name'>
										<input type='hidden' name='surname' value='$surname'>
										<input type='hidden' name='Fechas_execute' value='$Fechas_execute'>
										<input type='hidden' name='z' value='$z'>
									</fieldset>
									</form>";
	
		
							}
							?>	
						</p>
					</p>
				</div><!-- front-page -->
			</div><!-- content -->
			<?php
		}   
	}else{
		include '../index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html>
