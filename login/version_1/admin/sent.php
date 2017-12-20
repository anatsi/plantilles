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
		$z = $_POST["z"];
		$text = $_POST["text"];
		$opcion = $_POST["opcion"];
		$year_apply = $_POST["year_apply"];
		
		// Comprobamos si el login de usuario existe
        $checklogin = mysqli_query($conexion, "SELECT id_user FROM Users WHERE id_user='$id_user'");
        $login_exist = mysqli_num_rows($checklogin);
        if ($login_exist==0) {
			echo "<font color='red'>'El usuario no existe'</font>";
			include '../index.php';
		}else{
			$Fechas_execute=array();
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
					<p>
							<?php
							$Fechas_execute = $_POST['Fechas_execute'];
						    function array_recibe($url_array) 
						    {
							   $tmp = stripslashes($url_array);
							   $tmp = urldecode($tmp);
							   $tmp = unserialize($tmp);
							   return $tmp;
						    }//fin funcion
						    $Fechas_execute=array_recibe($Fechas_execute); 
							
							echo "<h1><table cellpadding='10' align='center'><tr><td><img src='../images/corecto.png' BORDER=0 ALIGN='bottom' ALT='OK' WIDTH='32' HEIGHT='32'></td><td>Acci&oacute;n Realizada</h1></td></tr></table>";
															
							//Averiguamos email trabajador
							$result = mysqli_query($conexion, "SELECT email FROM Users WHERE id_user='$id_user'");
							while($row=mysqli_fetch_row($result)){
								$email_employees= $row[0];
							}
							//echo $email_employees;
							?><p style='text-align: center;color:#000000;'><?php
							
							//Si las fechas son Aceptadas
							if ($z == 1){
								echo "Se ha enviado un correo a $name $surname informandole al respecto.<BR> D&iacute;as aceptados:<BR><BR>";
								for($i=0; $i<count($Fechas_execute); $i++){
									
									//Convertimos las dos fechas a formato BBDD
									$ano = substr($Fechas_execute[$i],6,4);
									$mes = substr($Fechas_execute[$i],3,2);
									$dia = substr($Fechas_execute[$i],0,2);
									$date = $ano . "-" . $mes . "-" . $dia;
					
									//Actualizamos datos en la BBDD
									$query = "UPDATE Days SET status=2, year='$year_apply' where id_user='$id_user' AND date='$date'";
									mysqli_query($conexion,$query) or die(mysqli_error());
									
									//Mandamos un email informando al trabajador	
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($Fechas_execute); $i++){
										$text .= "<B>".$Fechas_execute[$i]."</B><BR>";
									}				
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = $email_employees;			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN ACEPTADA DE DÍAS LIBRES");
									# Indicamos la cabecera y el cuerpo del mensaje a enviar
									$cabeceras = "MIME-Version: 1.0\r\n"; 
									$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$cabeceras .= "From: intranet.tsiberia.es <$email_origin>\r\n";
									$cuerpo = ' 
										<html> 
										<head> 
											<title></title> 
										</head> 
										<body> 
											<font face="Verdana" size=3>Buenos d&iacute;as '.$name_email.' '.$surname_email.',<BR><BR>
											se ha aceptado su petici&oacute;n de los siguiente/s d&iacute;a/s libre/s:<BR>
											'.$text.'<BR><BR>Puede consultar toda la informaci&oacute;n en nuestra plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									//Fin Email			
 
								}
							//Si las fechas son Rechazadas
							}elseif($z == 0){
								if($opcion !=4){
									//Transformamos variable numerico en texto
									if($opcion == 0){
										$opcion = "Aumento de producci&oacute;n.";
									}elseif($opcion == 1){
										$opcion = "Falta de personal.";
									}elseif($opcion == 2){
										$opcion = "D&iacutea ya solicitado por un compa&ntilde;ero.";
									}elseif($opcion == 3){
										$opcion = "Negociable, hablar con Manuel Agapito Vaquer.";
									}
									
									echo "Se ha enviado un correo a $name $surname informandole al respecto.<BR> D&iacute;as rechazados:<BR><BR> ";
									for($i=0; $i<count($Fechas_execute); $i++){
										//Convertimos las dos fechas a formato BBDD
										$ano = substr($Fechas_execute[$i],6,4);
										$mes = substr($Fechas_execute[$i],3,2);
										$dia = substr($Fechas_execute[$i],0,2);
										$date = $ano . "-" . $mes . "-" . $dia;
										
										//Actualizamos datos en la BBDD
										$query = "UPDATE Days SET status=1, answer='$text' where id_user='$id_user' AND date='$date'";
										mysqli_query($conexion,$query) or die(mysqli_error());
										
										//Mandamos un email informando al trabajador	
										$name_email = strtoupper($name);
										$surname_email = strtoupper($surname);
										$text_email = "";
										//Mostrar array de dias completo por email
										for($i=0; $i<count($Fechas_execute); $i++){
											$text_email .= "<B>".$Fechas_execute[$i]."</B><BR>";
										}				
										#Fecha y hora
										$fecha=date("j/F/Y - H:i:s");
										#Email destino
										$email = $email_employees;			
										# Codigo de envio de correo
										$email_origin = "TRANSPORT SERVICE IBERIA";
										# Indicamos el asunto
										$asunto= utf8_decode("RECHAZO PETICIÓN DIAS LIBRES");
										# Indicamos la cabecera y el cuerpo del mensaje a enviar
										$cabeceras = "MIME-Version: 1.0\r\n"; 
										$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
										$cabeceras .= "From: intranet.tsiberia.es <$email_origin>\r\n";
										$cuerpo = ' 
											<html> 
											<head> 
												<title></title> 
											</head> 
											<body> 
												<font face="Verdana" size=3>Buenos d&iacute;as '.$name_email.' '.$surname_email.',<BR><BR>
												se ha rechazado su petici&oacute;n de los siguiente/s d&iacute;a/s libre/s:<BR>
												'.$text_email.'<BR>El motivo del rechazo es el siguiente:<BR><B>'.$opcion.'</B><BR><BR><BR>Puede consultar toda la informaci&oacute;n en nuestra plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
												</font> 
											</body> 
											</html> 
											'; 
										#Funcion de envio del mensaje
										mail($email,$asunto,$cuerpo,$cabeceras);
										//Fin Email
										
									}
					
								}else{
									echo "Se ha enviado un correo a $name $surname informandole al respecto.<BR> D&iacute;as rechazados:<BR><BR> ";
									for($i=0; $i<count($Fechas_execute); $i++){
										//Convertimos las dos fechas a formato BBDD
										$ano = substr($Fechas_execute[$i],6,4);
										$mes = substr($Fechas_execute[$i],3,2);
										$dia = substr($Fechas_execute[$i],0,2);
										$date = $ano . "-" . $mes . "-" . $dia;
										
										//Actualizamos datos en la BBDD
										$query = "UPDATE Days SET status=1, answer='$text' where id_user='$id_user' AND date='$date'";
										mysqli_query($conexion,$query) or die(mysqli_error());
										
										//Mandamos un email informando al trabajador	
										$name_email = strtoupper($name);
										$surname_email = strtoupper($surname);
										$text_email = "";
										//Mostrar array de dias completo por email
										for($i=0; $i<count($Fechas_execute); $i++){
											$text_email .= "<B>".$Fechas_execute[$i]."</B><BR>";
										}				
										#Fecha y hora
										$fecha=date("j/F/Y - H:i:s");
										#Email destino
										$email = $email_employees;			
										# Codigo de envio de correo
										$email_origin = "TRANSPORT SERVICE IBERIA";
										# Indicamos el asunto
										$asunto= utf8_decode("RECHAZO PETICIÓN DIAS LIBRES");
										# Indicamos la cabecera y el cuerpo del mensaje a enviar
										$cabeceras = "MIME-Version: 1.0\r\n"; 
										$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
										$cabeceras .= "From: intranet.tsiberia.es <$email_origin>\r\n";
										$cuerpo = ' 
											<html> 
											<head> 
												<title></title> 
											</head> 
											<body> 
												<font face="Verdana" size=3>Buenos d&iacute;as '.$name_email.' '.$surname_email.',<BR><BR>
												se ha rechazado su petici&oacute;n de los siguiente/s d&iacute;a/s libre/s:<BR>
												'.$text_email.'<BR>El motivo del rechazo es el siguiente:<BR><B>'.$text.'</B><BR><BR><BR>Puede consultar toda la informaci&oacute;n en nuestra plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
												</font> 
											</body> 
											</html> 
											'; 
										#Funcion de envio del mensaje
										mail($email,$asunto,$cuerpo,$cabeceras);
										//Fin Email
										
									}
								}
							}else{
								echo "ERROR. Contacte con el administrador: vicente.catala.g@ts-iberica.com";
							}
							//MOSTRAR FECHAS ELEGIDAS PENDIENTES PARA APROBAR
							?><font size=3oem>
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
							</br></p>	
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

