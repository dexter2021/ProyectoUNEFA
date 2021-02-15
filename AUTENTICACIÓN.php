<?php
$login=$_POST['login'];
$clave=$_POST['clave'];
session_start();
$_SESSION['login']=$login;



include ('BASE DE DATOS SESIÓN.php');
$consulta="SELECT*FROM usuario where login='$login' and clave='$clave'";
$resultado=mysqli_query($conexion,$consulta);
$filas=mysqli_fetch_array($resultado);




if($filas['id_nivel']==1){                       //ADMINISTRADOR
    header("location: ../UNEFANB V-17558042 LENG-PROG-III\MÓDULO DE REGISTRO\ADMINISTRADOR.php");

  
}else 
    if($filas['id_nivel']==2){                        //USUARIO.
    header("location:../UNEFANB V-17558042 LENG-PROG-III\MÓDULO DE REGISTRO\USUARIO.php");
}
if(isset($_SESSION['login'])){ 
    echo "Bienvenido";
}
else{
    echo "intruso";
}


mysqli_free_result($resultado);
mysqli_close($conexion);











 