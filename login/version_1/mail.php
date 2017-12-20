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
	if (isset($_POST["name"])){
		$name = $_POST["name"];
		$surname = $_POST["surname"];

		$name = strtoupper($name);
		$surname = strtoupper($surname);			

		// Enviar el email				
		$mail = "robot@tsiberia.es";
			
		$header = 'From: ' . $mail . " \r\n";
		$header .= "X-Mailer: PHP/" . phpversion() . " \r\n";
		$header .= "Mime-Version: 1.0 \r\n";
		$header .= "Content-Type: text/plain; charset=UTF-8"; 

		$mensaje = "PORTAL DEL EMPLEADO" . " \r\n\r\n\r\n";
		$mensaje .= "Mensaje enviado por: " . $name . " " . $surname . " \r\n\r\n";
		$mensaje .= "Mensaje:" . " \r\n" . $_POST['text']. " \r\n\r\n\r\n";
		$mensaje .= "Por favor, no responda a este correo lo envia un robot automáticamente." . " \r\n";
		$mensaje .= "Enviado el " . date('d/m/Y', time());

		$para = 'manuel.agapito.v@ts-iberica.com';
		$copia= 'vicente.catala.g@ts-iberica.com';
		$asunto = 'Sugerencias/preguntas empleados TSI';
					
		if(mail("$para,$copia", $asunto, $mensaje, $header)) {
			echo "<font color='green'>'Mensaje enviado correctamente. Pronto recibir&aacute; noticias.'</font>";
			include './index.php';
		}
		else {
			echo "<font color='red'>'Error al enviar el mensaje. Por favor, intentelo de nuevo.'</font>";
			include './index.php';
		}   
	}else{
		include './index.php';
    }
mysqli_close($conexion);
?>
</body>               
</html>
