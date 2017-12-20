<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "DTD/xhtml1-transitional.dtd">
<html lang="es_ES.UTF-8">
<head>
    <title>TSIberia</title>
	<link rel="icon" href="./images/favicon.ico" type="image/x-icon" />
    <link rel="stylesheet" type="text/css" href="./main.css" />
    <link rel="stylesheet" type="text/css" href="./css/jscal2.css" />
    <link rel="stylesheet" type="text/css" href="./css/border-radius.css" />
    <link rel="stylesheet" type="text/css" href="./css/steel/steel.css" />
    <script type="text/javascript" src="./js/jscal2.js"></script>
    <script type="text/javascript" src="./js/lang/es.js"></script>
	<script type="text/javascript" src="./js/link.js"></script>
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
		RANGE_CAL_1 = new Calendar({
            disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_1",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_1",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_2 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_2",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_2",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_3 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_3",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_3",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_4 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_4",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_4",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_5 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_5",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_5",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_6 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_6",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_6",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_7 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_7",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_7",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_8 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_8",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_8",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_9 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_9",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_9",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_10 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_10",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_10",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_11 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_11",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_11",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_12 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_12",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_12",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_13 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_13",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_13",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_14 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_14",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_14",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
		RANGE_CAL_15 = new Calendar({
			disabled : function(date) {
				date = Calendar.dateToInt(date);
				return date in DISABLED_DATES;
			},
			min: 20140601,
			max: 20141231,
			inputField: "f_rangeStart_15",
			dateFormat: "%d/%m/%Y",
			trigger: "f_rangeStart_trigger_15",
			bottomBar: false,									 
			onSelect   : function() { this.hide() }
		});
	
		function clearRangeStart() {
			document.getElementById("f_rangeStart_1").value = "";
			document.getElementById("f_rangeStart_2").value = "";
			document.getElementById("f_rangeStart_3").value = "";
			document.getElementById("f_rangeStart_4").value = "";
			document.getElementById("f_rangeStart_5").value = "";
			document.getElementById("f_rangeStart_6").value = "";
			document.getElementById("f_rangeStart_7").value = "";
			document.getElementById("f_rangeStart_8").value = "";
			document.getElementById("f_rangeStart_9").value = "";
			document.getElementById("f_rangeStart_10").value = "";
			document.getElementById("f_rangeStart_11").value = "";
			document.getElementById("f_rangeStart_12").value = "";
			document.getElementById("f_rangeStart_13").value = "";			
			document.getElementById("f_rangeStart_14").value = "";
			document.getElementById("f_rangeStart_15").value = "";	
			LEFT_CAL.args.min = null;
			LEFT_CAL.redraw();
		};
	</script>
		 
<?php
	/* Capturo del dato */
	$dias = $_POST['dias'];
	$id = $_GET['user'];

	//Visualizo tantos calendarios como dias seleccionados
	if ($dias == 1){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value='Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar</button>";
	}
	else if ($dias == 2){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value='Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 3){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 4){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 5){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 6){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 7){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 8){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 9){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 10){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 11){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 11:</label>
				<input type='text' size='15' id='f_rangeStart_11' name='date11' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_11' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 12){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 11:</label>
				<input type='text' size='15' id='f_rangeStart_11' name='date11' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_11' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 12:</label>
				<input type='text' size='15' id='f_rangeStart_12' name='date12' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_12' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 13){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 11:</label>
				<input type='text' size='15' id='f_rangeStart_11' name='date11' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_11' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 12:</label>
				<input type='text' size='15' id='f_rangeStart_12' name='date12' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_12' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 13:</label>
				<input type='text' size='15' id='f_rangeStart_13' name='date13' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_13' ALT='cal' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 14){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal01' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal02' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal03' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal04' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal05' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal06' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal07' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal08' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal09' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal10' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 11:</label>
				<input type='text' size='15' id='f_rangeStart_11' name='date11' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_11' ALT='cal11' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 12:</label>
				<input type='text' size='15' id='f_rangeStart_12' name='date12' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_12' ALT='cal12' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 13:</label>
				<input type='text' size='15' id='f_rangeStart_13' name='date13' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_13' ALT='cal13' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 14:</label>
				<input type='text' size='15' id='f_rangeStart_14' name='date14' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_14' ALT='cal14' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else if ($dias == 15){
		echo "<form name='form' method='POST' action='./rdias.php'>
				<BR><label for='f_rangeStart'>Fecha 01:</label>
				<input type='text' size='15' id='f_rangeStart_1' name='date01' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_1' ALT='cal01' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 02:</label>
				<input type='text' size='15' id='f_rangeStart_2' name='date02' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_2' ALT='cal02' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 03:</label>
				<input type='text' size='15' id='f_rangeStart_3' name='date03' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_3' ALT='cal03' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 04:</label>
				<input type='text' size='15' id='f_rangeStart_4' name='date04' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_4' ALT='cal04' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 05:</label>
				<input type='text' size='15' id='f_rangeStart_5' name='date05' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_5' ALT='cal05' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 06:</label>
				<input type='text' size='15' id='f_rangeStart_6' name='date06' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_6' ALT='cal06' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 07:</label>
				<input type='text' size='15' id='f_rangeStart_7' name='date07' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_7' ALT='cal07' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 08:</label>
				<input type='text' size='15' id='f_rangeStart_8' name='date08' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_8' ALT='cal08' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 09:</label>
				<input type='text' size='15' id='f_rangeStart_9' name='date09' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_9' ALT='cal09' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 10:</label>
				<input type='text' size='15' id='f_rangeStart_10' name='date10' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_10' ALT='cal10' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 11:</label>
				<input type='text' size='15' id='f_rangeStart_11' name='date11' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_11' ALT='cal11' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 12:</label>
				<input type='text' size='15' id='f_rangeStart_12' name='date12' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_12' ALT='cal12' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 13:</label>
				<input type='text' size='15' id='f_rangeStart_13' name='date13' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_13' ALT='cal13' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 14:</label>
				<input type='text' size='15' id='f_rangeStart_14' name='date14' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_14' ALT='cal14' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<label for='f_rangeStart'>Fecha 15:</label>
				<input type='text' size='15' id='f_rangeStart_15' name='date15' readonly='readonly'>
				<img src='./images/cal.png' id='f_rangeStart_trigger_15' ALT='cal15' WIDTH='25' HEIGHT='20' /><BR><BR>
				
				<input type='hidden' name='user' value='$id'>
				<input type='submit' name='submit' value=Enviar petición'></form>
				<button id='f_clearRangeStart' onclick='clearRangeStart()'>Limpiar todo</button>";
	}
	else{
		echo "Error al leer los datos";
	}

?>
</body>               
</html>

