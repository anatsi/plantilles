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
 
	//Exite envio de variable
	if(isset($_POST["password"])){
		
		if($_POST["password"]!=NULL|$POST["password2"]!=NULL){
			
			$login =  strtolower($_POST["login"]);
			$login = trim($login);
			$password = $_POST["password"];
			$password2 = $_POST["password2"];
			
			
			//Sino coninciden las contraseñas
			if($password!=$password2) {				
				//conectamos bbdd
				$conexion = mysqli_connect("db523240012.db.1and1.com","dbo523240012","TSiberia17","db523240012");
				//Ingreso exitoso, ahora sera dirigido a la pagina principal.
				$login = $_POST["login"];	
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
							<h1>CAMBIO DE CONTRASE&Ntilde;A</h1>
							<p></br>
									<form name="frm" method="POST" action="./pass2.php">
										<fieldset id="form">
										<ol>
											<li><label><font color="red">Las contrase&ntilde;as no coinciden, intentelo de nuevo</font></label></li>  
											<li><label>Nueva Contrase&ntilde;a: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="password" name="password" size="25" /></li>   
											<li><label>Confirma nueva Contrase&ntilde;a: </label><input type="password" name="password2" size="25" /></li>
											<?php echo "<input type='hidden' name='login' value='$login'>";?>
										</ul>
										<p align="center"><input type="submit" name="submit" class="btn" value="Validar cambios" /></p>
										</fieldset>
									</form>
							</p>
						</div><!-- front-page -->
					</div><!-- content -->
					<?php
				} 	

			//Coinciden las contraseñas	
			}else{
				//conectamos bbdd
				$conexion = mysqli_connect("db523240012.db.1and1.com","dbo523240012","TSiberia17","db523240012"); 
				//Encriptamos el password en MD5
				$password=md5($password);
				$query = "UPDATE Users SET pass='$password' where user='$login'";
				mysqli_query($conexion,$query) or die(mysqli_error());
				echo '<font color="green">"Contrase&ntilde;a modificada correctamente. Entre con su nueva contrase&ntildea"</font>';
				include './index.php';   
		
			}
		
		// Campos de contraseña en blanco	 	
		}else{
			//conectamos bbdd
			$conexion = mysqli_connect("db523240012.db.1and1.com","dbo523240012","TSiberia17","db523240012"); 
			//Ingreso exitoso, ahora sera dirigido a la pagina principal.
			$login = $_POST["login"];	
			// Comprobamos si el login de usuario existe
			$checklogin = mysqli_query($conexion, "SELECT user FROM Users WHERE user='$login'");
			$login_exist = mysqli_num_rows($checklogin);    
			if ($login_exist==0) {
				echo "<font color='red'>'El usuario no existe'</font>";
				include './index.php';
			}else{
				//Averiguamos el Nombre y Apellidos del usuario
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
											echo "<td><a href=./dias.php?user=$login_encode>PETICION DIAS LIBRES</a></td>";
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
						<h1>CAMBIO DE CONTRASE&Ntilde;A</h1>
						<p></br>
								<form name="frm" method="POST" action="./pass2.php">
									<fieldset id="form">
									<ol>
										<li><label><font color="red">Error no debe dejar ningun campo vacio</font></label></li>  
										<li><label>Nueva Contrase&ntilde;a: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label><input type="password" name="password" size="25" /></li>   
										<li><label>Confirma nueva Contrase&ntilde;a: </label><input type="password" name="password2" size="25" /></li>
										<?php echo "<input type='hidden' name='login' value='$login'>";?>
									</ul>
									<p align="center"><input type="submit" name="submit" class="btn" value="Validar cambios" /></p>
									</fieldset>
								</form>
						</p>
					</div><!-- front-page -->
				</div><!-- content -->
				<?php
			} 			
		}	   
	}else
		include './index.php';
mysqli_close($conexion);
?>
</body>               
</html>
