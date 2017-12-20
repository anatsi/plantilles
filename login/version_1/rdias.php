<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
    <title>TSIberia</title>
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/main.css" />
    <link rel="stylesheet" type="text/css" href="/css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="/css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="/css/steel/steel.css" />
    <script type="text/javascript" src="/js/jscal2.js"></script>
    <script type="text/javascript" src="/js/lang/es.js"></script>
	<script type="text/javascript" src="/js/link.js"></script>
	
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
    $conexion = mysql_connect("db523240012.db.1and1.com","dbo523240012","TS-iberica2014");
    mysql_select_db("db523240012",$conexion);     
	if (isset($_POST["user"])){
		//Ingreso exitoso, ahora sera dirigido a la pagina principal.
		$id = $_POST["user"];	
		$login = decode($id);
		// Comprobamos si el login de usuario existe
        $checklogin = mysql_query("SELECT user FROM Users WHERE user='$login'",$conexion);
        $login_exist = mysql_num_rows($checklogin);    
        if ($login_exist==0) {
			echo "<font color='red'>'El usuario no existe'</font>";
			include 'index.php';
		}else{	
			//Averiguamos el ID, Nombre y Apellidos del usario
			$result = mysql_query("SELECT name, surname, id_user FROM Users WHERE user='$login'",$conexion);
			$row = mysql_fetch_row($result);
			$name = $row[0];
			$surname = $row[1];
			$id_user = $row[2];
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
								echo "&nbsp;&nbsp;&nbsp;<acronym title='Opciones'><a href=opciones.php?user=$login_encode><img src='/images/opciones.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='25' HEIGHT='25'></a></acronym>&nbsp;&nbsp;<acronym title='Salir'><a href='logout.php'><img src='/images/BotonSalir.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='25' HEIGHT='25'></a></acronym>";
							
								?></h2>
							
							</div>
							<div id="logo">
								<img  src="/images/logo_188_114_png.png" border="0" alt="Logo TSI" />
							</div>
						</div>
						<div id="menu-bar" align="center">
							<table cellspacing="0" cellpadding="0" border="0" width="100%" align="center">
									<tr>
										<?php 
										echo "<td><a href=/dias.php?user=$login_encode>PETICI&Oacute;N D&Iacute;AS LIBRES</a></td>";
										echo "<td><a href=/sugerencias.php?user=$login_encode>SUGERENCIAS/PREGUNTAS</a></td>";?>
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
					<h1>PETICI&Oacute;N D&Iacute;AS LIBRES</h1>
						<p>
						Dispone de dos modalidades para la petici&oacute;n de d&iacute;as libres.<BR>A su izquierda si quiere pedir un intervalo de m&aacute;s de 15 d&iacute;as seguidos y su derecha si quiere pedir d&iacute;as sueltos contiguos o alternos, siempre un n&uacute;mero menor a 15 d&iacute;as.
						<table cellpadding='10'>
							<tr>
								<td VALIGN="TOP">
						<?php
							
							//Respuesta formulario intervalo de fechas
							if(isset($_POST["start_date"])){	
								
								//Capturar datos del formulario via POST
								$start_date = $_POST["start_date"];
								$end_date = $_POST["end_date"];
								
								// Si no hay campos en blanco
								if($start_date!=NULL && $end_date!=NULL) {
								
									//Convierto fechas a formato ingles para poder trabajar con ellas
									$ano = substr($start_date,6,4);
									$mes = substr($start_date,3,2);
									$dia = substr($start_date,0,2);
									$start_date2 = $mes . "/" . $dia . "/" . $ano;
									$ano = substr($end_date,6,4);
									$mes = substr($end_date,3,2);
									$dia = substr($end_date,0,2);
									$end_date2 = $mes . "/" . $dia . "/" . $ano;
									
									$fechaInicio=strtotime($start_date2);
									$fechaFin=strtotime($end_date2);
									$arrayFechas=array();
									$dia_semana=array();
									
									//Comparamos intervalo fechas en formato strtotime
									if ($fechaFin > $fechaInicio){
										
										//Guardo en array todas las fechas entre el intervalo en formato UNIX
										for($i=$fechaInicio; $i<=$fechaFin; $i+=86400){
											$arrayFechas[] = date($i);
										}
										
										//Guardo en otra array el numero de día de la semana
										for($i=0; $i<count($arrayFechas); $i++){
											$dia_semana[] = date("w", $arrayFechas[$i]);
										}	

										//Eliminio del array de fechas los sabados y domingos
										for($i=0; $i<count($dia_semana); $i++){
											if ($dia_semana[$i] == 6){
												unset($arrayFechas[$i]);
											}
											if ($dia_semana[$i] == 0){
												unset($arrayFechas[$i]);
											}
										}
										$arrayFechas = array_values($arrayFechas);

										//Guardo en array todas las fechas entre el intervalo en formato normal
										for($i=0; $i<count($arrayFechas); $i++){
											$arrayFechas[$i] = date("Y-m-d", $arrayFechas[$i]);
										}

										//Comprobamos que los dias sean mas de 15 laborables
										$cont = count($arrayFechas);
										if ($cont < 15){
											echo '<font color="red">"ERROR. El intervalo debe ser superior a 15 d&iacute;as laborables"</font>';
										}
										else{
											echo "<BR>";
											//Averiguamos resumen días por trabajador
											$result = mysql_query("SELECT date, status FROM Days WHERE id_user='$id_user'",$conexion);
											$Fechas_pendientes=array();
											$Fechas_rechazadas=array();
											$Fechas_aceptadas=array();
											$Fechas_ya_pendientes=array();
											$Fechas_ya_rechazadas=array();
											$Fechas_ya_aceptadas=array();
											while($row=mysql_fetch_row($result)){
												if($row[1]==0){
													$Fechas_pendientes[] = $row[0];
												}elseif($row[1]==1){
													$Fechas_rechazadas[] = $row[0];
												}else{
													$Fechas_aceptadas[] = $row[0];				

												}
											}//Fin averiguar resumen días
											
											//Comprabamos si algún día solicitado ya esta pendiente, si es así guardamos en array
											for($i=0; $i<count($Fechas_pendientes); $i++){
												for($j=0; $j<count($arrayFechas); $j++){
													if ($Fechas_pendientes[$i] == $arrayFechas[$j]){
														$Fechas_ya_pendientes[] = $Fechas_pendientes[$i];
													}
												}
											}
											//Comprabamos si algún día solicitado ya esta rechazado, si es así guardamos en array
											for($i=0; $i<count($Fechas_rechazadas); $i++){
												if ($Fechas_rechazadas[$i] == $arrayFechas[$i]){
													$Fechas_ya_rechazadas[] = $Fechas_rechazadas[$i];
													}
											}
											//Comprabamos si algún día solicitado ya esta aceptado, si es así guardamos en array
											for($i=0; $i<count($Fechas_aceptadas); $i++){
												if ($Fechas_aceptadas[$i] == $arrayFechas[$i]){
													$Fechas_ya_aceptadas[] = $Fechas_aceptadas[$i];
													}
											}
											//Comprobamos si algún array tiene alguna fecha almacenada,esto quiere decir que hemos pedido algún dia que ya estaba tratado en la BBDD
											if($Fechas_ya_pendientes != NULL){
												echo "<font color='red'>Alguna fecha ya fue solicitada con anterioridad. </font><BR>- Fechas ya solicidadas pendientes:<BR>";
												for($i=0; $i<count($Fechas_ya_pendientes); $i++){
													if ($i == 4){
														echo "<BR>";
													}
													echo $Fechas_ya_pendientes[$i].", ";
												}
											}
											elseif($Fechas_ya_rechazadas != NULL){
												echo "<font color='red'>Alguna fecha ya fue solicitada con anterioridad. </font><BR>- Fechas ya solicidadas rechazadas:<BR>";
												for($i=0; $i<count($Fechas_ya_rechazadas); $i++){
													
													echo $Fechas_ya_rechazadas[$i].", ";
												}
											}
											elseif($Fechas_ya_aceptadas != NULL){
												echo "<font color='red'>Alguna fecha ya fue solicitada con anterioridad. </font><BR>- Fechas ya solicidadas aceptadas:<BR>";
												for($i=0; $i<count($Fechas_ya_aceptadas); $i++){
													echo $Fechas_ya_aceptadas[$i].", ";
												}
											}
											else{
												echo "BIEN";
												/*$request_day = date("Y-m-d");
												for($i=0; $i<count($arrayFechas); $i++){
													//Insertamos dias en la BD
													$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
													if (mysql_query($query,$conexion) == true){
														$tool = true;
													}
												}
												if ($tool == true){
													echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
													//Mandamos un email al responsable
														$login_email = strtoupper($login);		
														$name_email = strtoupper($name);
														$surname_email = strtoupper($surname);
														$text = "Del <B>".$start_date."</B> al <B>".$end_date."</B>";
														//Mostrar array de dias completo por email
														/*for($i=0; $i<count($arrayFechas); $i++){
															$text .= "<B>".$arrayFechas[$i]."</B><BR>";
														}*/
														
														#Fecha y hora
														/*$fecha=date("j/F/Y - H:i:s");
														#Email destino
														$email = 'vicente.catala.g@ts-iberica.com';			
														# Codigo de envio de correo
														$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
														# Indicamos el asunto
														$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
																<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
																'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
																'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
																</font> 
															</body> 
															</html> 
															'; 
														#Funcion de envio del mensaje
														mail($email,$asunto,$cuerpo,$cabeceras);
														#mostrar resultado de envio realizado correctamente
														echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
														echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
														//Fin Email	
												}else{
													echo '<font color="red">Problemas con la base de datos. Intentelo m&aacute;s tarde."</font><BR>';
												}*/
													
											}
										}
									//La segunda fecha no puede ser menor a la primera	
									}else {
										echo '<font color="red">"ERROR. La segunda fecha no puede ser menor que la primera"</font>';
									}
								//Hay campos en blanco
								}else{
									echo '<font color="red">"ERROR. Alg&uacute;n campo vacio"</font>';	
								}	
							}
							//Muestro formulario fechas intervalo	
							echo "<form name='form_interval' method='POST' action='rdias.php'>
									<BR><b>- Intervalo de fechas (Min. 15 d&iacute;as)</b><BR><BR>
									
									<label for='f_rangeStart'>De </label>
									<input type='text' size='15' id='f_rangeStart_20' name='start_date' readonly='readonly'>
									<img src='/images/cal.png' id='f_rangeStart_trigger_20' ALT='cal' WIDTH='25' HEIGHT='20' />
									
									<label for='f_rangeStart'>&nbsp;Hasta </label>
									<input type='text' size='15' id='f_rangeStart_21' name='end_date' readonly='readonly'>
									<img src='/images/cal.png' id='f_rangeStart_trigger_21' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
									<input type='hidden' name='user' value='$id'>
									
									<input type='submit' name='submit' value='Enviar petici&oacute;n'></form>
									<button id='f_clearRangeStart_2' onclick='clearRangeStart_2()'>Limpiar</button>";
							?>
						</p>
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
						<td width="150" ALIGN="center"><img src='/images/linea4.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='330'></td>
						<td VALIGN="TOP">
						<?php
						
						//Tratamiento datos fechas sueltas
						if (isset($_POST["date01"])){
							if (isset($_POST["date15"])){
								if ($_POST["date15"]!=NULL && $_POST["date14"]!=NULL && $_POST["date13"]!=NULL && $_POST["date12"]!=NULL && $_POST["date11"]!=NULL && $_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									$arrayFechas_mostrar[] = $_POST["date11"];
									$arrayFechas_mostrar[] = $_POST["date12"];
									$arrayFechas_mostrar[] = $_POST["date13"];
									$arrayFechas_mostrar[] = $_POST["date14"];
									$arrayFechas_mostrar[] = $_POST["date15"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date11"],6,4);
									$mes = substr($_POST["date11"],3,2);
									$dia = substr($_POST["date11"],0,2);
									$date11 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date12"],6,4);
									$mes = substr($_POST["date12"],3,2);
									$dia = substr($_POST["date12"],0,2);
									$date12 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date13"],6,4);
									$mes = substr($_POST["date13"],3,2);
									$dia = substr($_POST["date13"],0,2);
									$date13 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date14"],6,4);
									$mes = substr($_POST["date14"],3,2);
									$dia = substr($_POST["date14"],0,2);
									$date14 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date15"],6,4);
									$mes = substr($_POST["date15"],3,2);
									$dia = substr($_POST["date15"],0,2);
									$date15 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									$arrayFechas[] = $date11;
									$arrayFechas[] = $date12;
									$arrayFechas[] = $date13;
									$arrayFechas[] = $date14;
									$arrayFechas[] = $date15;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
									
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date14"])){
								if ($_POST["date14"]!=NULL && $_POST["date13"]!=NULL && $_POST["date12"]!=NULL && $_POST["date11"]!=NULL && $_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									$arrayFechas_mostrar[] = $_POST["date11"];
									$arrayFechas_mostrar[] = $_POST["date12"];
									$arrayFechas_mostrar[] = $_POST["date13"];
									$arrayFechas_mostrar[] = $_POST["date14"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date11"],6,4);
									$mes = substr($_POST["date11"],3,2);
									$dia = substr($_POST["date11"],0,2);
									$date11 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date12"],6,4);
									$mes = substr($_POST["date12"],3,2);
									$dia = substr($_POST["date12"],0,2);
									$date12 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date13"],6,4);
									$mes = substr($_POST["date13"],3,2);
									$dia = substr($_POST["date13"],0,2);
									$date13 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date14"],6,4);
									$mes = substr($_POST["date14"],3,2);
									$dia = substr($_POST["date14"],0,2);
									$date14 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									$arrayFechas[] = $date11;
									$arrayFechas[] = $date12;
									$arrayFechas[] = $date13;
									$arrayFechas[] = $date14;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date13"])){
								if ($_POST["date13"]!=NULL && $_POST["date12"]!=NULL && $_POST["date11"]!=NULL && $_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									$arrayFechas_mostrar[] = $_POST["date11"];
									$arrayFechas_mostrar[] = $_POST["date12"];
									$arrayFechas_mostrar[] = $_POST["date13"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date11"],6,4);
									$mes = substr($_POST["date11"],3,2);
									$dia = substr($_POST["date11"],0,2);
									$date11 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date12"],6,4);
									$mes = substr($_POST["date12"],3,2);
									$dia = substr($_POST["date12"],0,2);
									$date12 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date13"],6,4);
									$mes = substr($_POST["date13"],3,2);
									$dia = substr($_POST["date13"],0,2);
									$date13 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									$arrayFechas[] = $date11;
									$arrayFechas[] = $date12;
									$arrayFechas[] = $date13;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
										
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date12"])){
								if ($_POST["date12"]!=NULL && $_POST["date11"]!=NULL && $_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									$arrayFechas_mostrar[] = $_POST["date11"];
									$arrayFechas_mostrar[] = $_POST["date12"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date11"],6,4);
									$mes = substr($_POST["date11"],3,2);
									$dia = substr($_POST["date11"],0,2);
									$date11 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date12"],6,4);
									$mes = substr($_POST["date12"],3,2);
									$dia = substr($_POST["date12"],0,2);
									$date12 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									$arrayFechas[] = $date11;
									$arrayFechas[] = $date12;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date11"])){
								if ($_POST["date11"]!=NULL && $_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									$arrayFechas_mostrar[] = $_POST["date11"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date11"],6,4);
									$mes = substr($_POST["date11"],3,2);
									$dia = substr($_POST["date11"],0,2);
									$date11 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									$arrayFechas[] = $date11;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date10"])){
								if ($_POST["date10"]!=NULL && $_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									$arrayFechas_mostrar[] = $_POST["date10"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date10"],6,4);
									$mes = substr($_POST["date10"],3,2);
									$dia = substr($_POST["date10"],0,2);
									$date10 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									$arrayFechas[] = $date10;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date09"])){
								if ($_POST["date09"]!=NULL && $_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									$arrayFechas_mostrar[] = $_POST["date09"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date09"],6,4);
									$mes = substr($_POST["date09"],3,2);
									$dia = substr($_POST["date09"],0,2);
									$date09 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									$arrayFechas[] = $date09;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date08"])){
								if ($_POST["date08"]!=NULL && $_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									$arrayFechas_mostrar[] = $_POST["date08"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date08"],6,4);
									$mes = substr($_POST["date08"],3,2);
									$dia = substr($_POST["date08"],0,2);
									$date08 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									$arrayFechas[] = $date08;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date07"])){
								if ($_POST["date07"]!=NULL && $_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									$arrayFechas_mostrar[] = $_POST["date07"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date07"],6,4);
									$mes = substr($_POST["date07"],3,2);
									$dia = substr($_POST["date07"],0,2);
									$date07 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									$arrayFechas[] = $date07;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date06"])){
								if ($_POST["date06"]!=NULL && $_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									$arrayFechas_mostrar[] = $_POST["date06"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date06"],6,4);
									$mes = substr($_POST["date06"],3,2);
									$dia = substr($_POST["date06"],0,2);
									$date06 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									$arrayFechas[] = $date06;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};	
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date05"])){
								if ($_POST["date05"]!=NULL && $_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									$arrayFechas_mostrar[] = $_POST["date05"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date05"],6,4);
									$mes = substr($_POST["date05"],3,2);
									$dia = substr($_POST["date05"],0,2);
									$date05 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									$arrayFechas[] = $date05;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date04"])){
								if ($_POST["date04"]!=NULL && $_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									$arrayFechas_mostrar[] = $_POST["date04"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date04"],6,4);
									$mes = substr($_POST["date04"],3,2);
									$dia = substr($_POST["date04"],0,2);
									$date04 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									$arrayFechas[] = $date04;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date03"])){
								if ($_POST["date03"]!=NULL && $_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									$arrayFechas_mostrar[] = $_POST["date03"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date03"],6,4);
									$mes = substr($_POST["date03"],3,2);
									$dia = substr($_POST["date03"],0,2);
									$date03 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									$arrayFechas[] = $date03;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
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
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}elseif (isset($_POST["date02"])){
								if ($_POST["date02"]!=NULL && $_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
									
									//Guardo fechas en array para mostrar en email
									$arrayFechas_mostrar[] = $_POST["date01"];
									$arrayFechas_mostrar[] = $_POST["date02"];
									
									//Convierto fechas a formato date BBDD para poder guardarlas correctamente
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$ano = substr($_POST["date02"],6,4);
									$mes = substr($_POST["date02"],3,2);
									$dia = substr($_POST["date02"],0,2);
									$date02 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;
									$arrayFechas[] = $date02;
									
									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B><BR>";
									}
													
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									# Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									# Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
									# Indicamos la cabecera y el cuerpo del mensaje a enviar
									$cabeceras = "MIME-Version: 1.0\r\n"; 
									$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$cabeceras .= "From: intranet.tsiberia.es <$email_origin>\r\n";
									$cuerpo = " 
										<html> 
										<head> 
											<title></title> 
										</head> 
										<body> 
											<font face='Verdana' size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href='http://www.intranet.tsiberia.es'>http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										"; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email		
								
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}else{
								if ($_POST["date01"]!=NULL){
									$arrayFechas=array();
									$arrayFechas_mostrar=array();
							
									//Guardo fechas validas para mostrar por email
									$arrayFechas_mostrar[] = $_POST["date01"];
									
									//Convierto fechas a formato date BBDD para poder trabajar con ellas
									$ano = substr($_POST["date01"],6,4);
									$mes = substr($_POST["date01"],3,2);
									$dia = substr($_POST["date01"],0,2);
									$date01 = $ano . "-" . $mes . "-" . $dia;
									$arrayFechas[] = $date01;

									echo "<table cellpadding='10'><tr><td><img src='/images/corecto.png' BORDER=0 ALIGN='bottom' ALT='SALIR' WIDTH='32' HEIGHT='32'></td><td><font color='green'>Petici&oacute;n realizada</font></td></tr></table>";
									for($i=0; $i<count($arrayFechas); $i++){
										//Insertamos dias en la BD
										$request_day = date("Y-m-d");		 
										$query = "INSERT INTO Days (id_user, request_day, date, status) VALUES ('$id_user', '$request_day', '$arrayFechas[$i]', 0)";
										mysql_query($query,$conexion) or die(mysql_error());
									};
									
									//Mandamos un email al responsable
									$login_email = strtoupper($login);		
									$name_email = strtoupper($name);
									$surname_email = strtoupper($surname);
									$text = "";
		
									//Mostrar array de dias completo por email
									for($i=0; $i<count($arrayFechas_mostrar); $i++){
										$text .= "<B>".$arrayFechas_mostrar[$i]."</B>";
									}			
									#Fecha y hora
									$fecha=date("j/F/Y - H:i:s");
									#Email destino
									$email = 'vicente.catala.g@ts-iberica.com';			
									#Codigo de envio de correo
									$email_origin = "TRANSPORT SERVICE IBERIA S.L.";
									#Indicamos el asunto
									$asunto= utf8_decode("PETICIÓN DIAS LIBRES");
									#Indicamos la cabecera y el cuerpo del mensaje a enviar
									$cabeceras = "MIME-Version: 1.0\r\n"; 
									$cabeceras .= "Content-type: text/html; charset=iso-8859-1\r\n"; 
									$cabeceras .= "From: intranet.tsiberia.es <$email_origin>\r\n";
									$cuerpo = ' 
										<html> 
										<head> 
											<title></title> 
										</head> 
										<body> 
											<font face="Verdana" size=3>Buenos d&iacute;as Manuel,<BR><BR>
											'.$name_email.' '.$surname_email.' realiz&oacute; la siguiente petici&oacute;n de d&iacute;as libres:<BR>
											'.$text.'<BR><BR>Para la resoluci&oacute;n de la petici&oacute;n acceda a la plataforma corporativa <a href="http://www.intranet.tsiberia.es">http://www.intranet.tsiberia.es</a>
											</font> 
										</body> 
										</html> 
										'; 
									#Funcion de envio del mensaje
									mail($email,$asunto,$cuerpo,$cabeceras);
									#mostrar resultado de envio realizado correctamente
									echo "<b>$name_email</b>, se ha registrado correctamente su petici&oacute;n.<br />";
									echo "Se lo contestar&aacute;, via email, con la mayor brevedad posible.";
									//Fin Email	
									
								}else
									echo '<font color="red">"ERROR. Alg&uacute;n campo fecha vacio"</font>';
							}
						}	
						// Muestro formulario dias sueltos
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
							 var url = "cal.php?user=<?php echo $id; ?>"; // El script a dónde se realizará la petición.
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
		include 'index.php';
    }
mysql_close($conexion);
?>
</body>               
</html>
