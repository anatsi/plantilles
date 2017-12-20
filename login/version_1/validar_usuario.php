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
	//declaro las funciones que encripta la variable GET
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
		$login = strtolower($_POST["login"]); 
		$password = $_POST["password"];
		// Hay campos en blanco
		if($login!=NULL && $password!=NULL) {
			// Comprobamos si el login de usuario existe
            $checklogin = mysqli_query($conexion, "SELECT user FROM Users WHERE user='$login'");
            $login_exist = mysqli_num_rows($checklogin);
            //printf("El resultado tiene %d filas.\n", $login_exist);
            if ($login_exist==0) {
                echo "<font color='red'>'El usuario no existe'</font>";
				include 'index.php';
			}else{
				$result = mysqli_query($conexion, "SELECT pass, permit FROM Users WHERE user='$login'");
				$row = mysqli_fetch_row($result);
				$password = md5($password);
				if($row[0] == $password){
					$login_encode = encode($login);
					if($row[1] != 1){
						//Ingreso exitoso, ahora sera dirigido a la pagina principal del Administrador
						echo "<SCRIPT LANGUAGE='javascript'>location.href = './admin/admin.php?user=$login_encode';</SCRIPT>";
					}else{
						//header('Location: ./home.php?user=$login_encode');
						echo "<SCRIPT LANGUAGE='javascript'>location.href = './home.php?user=$login_encode';</SCRIPT>";
					}
				}else{
					echo '<font color="red">"Contrase&ntilde;a incorrecta"</font>';
					include 'index.php';	
				}
			}
		}else{
		echo '<font color="red">"Falta alg&uacute;n campo por completar"</font>';
		include 'index.php';		
		}    
	}else{
		include 'index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html> 
