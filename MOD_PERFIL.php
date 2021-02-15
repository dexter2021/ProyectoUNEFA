<?php 
include 'conexion.php'
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width">
    <title>Login Php mysqli mas foto de perfil</title>
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/font-awesome.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link href='http://fonts.googleapis.com/css?family=Slabo+27px|Lobster' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="scripts/carga_imagen.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
</head>
 
  <body>
 
    <!--verificamos las sesion para habilitar las cabeceras-->
    <header class="cabecera-barra">
        <?php if (!isset($_SESSION['MM_Id']))
        {?> 
        <div class="cabecera-barra-1">
           <?php include 'cabecera-barra1.php'; ?> 
        </div>
        <?php }?>   
 
        <?php if (isset($_SESSION['MM_Id']))
        {?> 
        <div class="cabecera-barra-2">
             <?php include 'cabecera-barra2.php'; ?> 
        </div>
        <?php }?>   
   </header>
    
    <!--contenido-->
    <section class="contenido">
        <article class="post"><?php if (isset ($_SESSION ['MM_Id'])){
             echo '<p class="info">Usted ha iniciado sesión como usuario registrado:</p>';
             echo '
             <div class="tablauser" >
                <table >
                    <tr>
                        <td>
                            Correo
                        </td>
                        <td >
                            Usuario
                        </td>
                        <td>
                            Foto de perfil
                        </td>
                    </tr>
                    <tr>
                        <td >
                         <a href="mailto:'.$_SESSION['MM_mail_user'].'?Subject=Sujeto%20de%20envio" target="_top">'.$_SESSION['MM_mail_user'].'</a>
                        </td>
                        <td>
                          <a href="perfil.php">'.$_SESSION["MM_Nick_user"].'</a>
                        </td>
                        <td>'; ?>
                            <!--verificamos la subida de imagen con php-->
                            <?php
                                @$actualizar = $_REQUEST['actualizar'];
                                @$error = false;
                                //array de archivos disponibles
                                @$archivos_disp_ar = array('jpg', 'jpeg', 'gif', 'png');
                                //carpteta donde vamos a guardar la imagen
                                @$carpeta = 'user/';
                                //recibimos el campo de imagen
                                @$imagen = $_FILES['imagen']['tmp_name'];
                                //guardamos el nombre original de la imagen en una variable
                                @$nombrebre_orig = $_FILES['imagen']['name'];
                                //el proximo codigo es para ver que extension es la imagen
                                @$array_nombre = explode('.',$nombrebre_orig);
                                @$cuenta_arr_nombre = count($array_nombre);
                                @$extension = strtolower($array_nombre[--$cuenta_arr_nombre]);
                                //creamos nuevo nombre para que tenga nombre unico
                                @$nombre_nuevo = time().'_'.rand(0,100).'.'.$extension;
                                //nombre nuevo con la carpeta
                                @$nombre_nuevo_con_carpeta = $carpeta.$nombre_nuevo;
 
                             if (isset($actualizar))
                             {//ingreso datos
                                      if(!in_array($extension, $archivos_disp_ar))
                                      {
                                       {
                                         @$errores["imagen"]="Esto no es una imagen";
                                         $error = true;
                                       }
                                      if(trim($imagen)== "")
                                        {
                                         @$errores["imagen"]="Ingrese una imagen";
                                         $error = true;
                                        }
                                      }
                                      else
                                        @$errores["imagen"]="";
                             }
                        // Si los datos son correctos, procesar formulario
                        if (isset($actualizar) && $error==false)
                        {
                             
                            $id= $_SESSION ['MM_Id'];
                            $actualiza="Update login_php_mysql_foto_prefil Set foto_user='$nombre_nuevo' Where id_user='$id'";
                            $resultado = $link->query($actualiza);
                            $mover_archivos = move_uploaded_file($imagen , $nombre_nuevo_con_carpeta);
                             
                            $_SESSION['MM_Foto_user'] = NULL;
                            unset($_SESSION['MM_Foto_user']);
                             
                            $select_foto = "SELECT foto_user FROM login_php_mysql_foto_prefil WHERE id_user='$id'" or die("Error en la consulta" . mysqli_error($link));
                            $res_foto = $link->query($select_foto);
                            $ses = $res_foto->fetch_assoc();
                            $_SESSION['MM_Foto_user'] = $ses['foto_user'];
                             
                            //echo "<img src='" . $carpeta . $nombre_nuevo . "' alt='' width='100' height='100' />";
                            //echo "<br/>";
                            echo "Se le asignó nuevo Nombre de imagen  :  " . $nombre_nuevo;
                            echo'<img style="width:40%; margin-top:10px;" src="user/'.$_SESSION['MM_Foto_user'].'" alt="'.$_SESSION['MM_Nick_user'].'"/>';
                             
                        }
                          else
                            {
                            ?>
                          <img id="thumbnil" style="width:40%; margin-top:10px;"/>
                          <br/>
                          <!--formulario de envío -->
                          <form action="" name="actualizar" enctype="multipart/form-data" method="post">
                          <div class="escogerFoto">
                           <span> Escoja su Imagen </span>
                          <input class="escoger" type="file" accept="image/*"  onchange="showMyImage(this)"  name="imagen"
                             <?PHP
                                 if (isset($actualizar))
                                    //obtenemos el nombre de la imagen
                                    print ("VALUE='$imagen'/>\n");
                                else
                                    print ("/>\n");
                                 if (@$errores["imagen"] != "")
                                    //mostramos errores si los hay
                                    print ("<BR><SPAN CLASS='error'>" . @$errores["imagen"] . "</SPAN>");
                              ?>
                           </div>
                          <input class="enviar-foto" type="submit" value="actualizar" name="actualizar"/>
                          </form>
                          <?PHP
                            }
                          ?>
 
                         <?php 
                        echo '</td>
                    </tr>
                </table>
            </div>';
             }
             //si no ha iniciado sesión mostramos mensaje
             else {
                 echo '<p class="info">Deberá Iniciar sesión para ver su perfil...</p>';
                 }?>
                 </article>
    </section>
     
    <?php include 'contenido_lateral.php'; ?>
    <?php include 'footer.php'; ?>
 
  </body>
</html>