<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
 
    <title>TSIberia</title>
	<link rel="icon" href="/images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="/main_index.css" />
	<script type="text/javascript" src="/js/link.js"></script>

</head>
<body>
	
<?php session_start();
    // Borramos toda la sesion
    session_destroy();
	echo '<font color="red">"SESI&Oacute;N FINALIZADA"</font>';
	include 'index.php';
?>
</body>               
</html>
