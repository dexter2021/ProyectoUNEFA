<?php
if(isset ($_POST['submit'])) {
	if(isset ($nombre)) {
	echo "<p class= 'error'>* Agregar tu nombre </p>"; 
	} else{
	if(strlen ($nombre)> 15 {
		echo "<p class= 'error'>* El nombre es muy largo </p>"; 
	}
		}

	if(isset ($edad)) {
	echo "<p class= 'error'>* Agregar tu nombre </p>"; 
		} else{
	if(!is_numeric($edad)> 15 {
		echo "<p class= 'error'>* La edad debe ser un numero </p>"; 
		}
			}

		if(empty($correo)) {
	echo "<p class= 'error'>* Agregar tu nombre </p>"; 
		}else{
			if(!filter_var($correo, FILTER_VALIDATE_EMAIL))
				echo "<p class= 'error'>* eL COOREO ES INCORRECTO</p>";
				}

		}
			}

















?>