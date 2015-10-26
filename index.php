<!DOCTYPE>
<?php
   require './clases/AutoCarga.php';
 ?>
    <html>

    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="main.css">
        <script src='js/audio.js'></script>
        <title></title>
    </head>

    <body>
        <div id="titulo">
            <h1>Mi podcast</h1></div>
        <div id="principal">
            <div id="izquierda">
                <?php
          
                $sesion=new Session();
                if(!$sesion->get("usuario")){
                    
                ?>
                    <form action="phplogin.php" method="post" enctype="multipart/form-data" /> Usuario:
                    <input type="text" name="usuario1" placeholder="usuario" />
                    <input type="submit">
                    </form>
                    <?php
                }
                 else{
           ?>
                        <div id="formularioInsercion">
                            <form action="phpsubir.php" method="post" enctype="multipart/form-data">
                                <fieldset>
                                    <legend><b>Inserta tus canciones</b></legend>
                                    Categoría:
                                    <input type="text" name="categoria1" placeholder="categoria" size="30" />
                                    <br/> Canción:
                                    <input type="file" name="archivo" />
                                    <br/> Imagen:
                                    <input type="file" name="imagen" />
                                </fieldset>
                                <input type="submit" value="Subir archivo" />
                            </form>
                        </div>
                        <form action="phplogout.php">
                            <fieldset>
                                <legend><b>Sesión activa</b></legend>
                                <?php
                echo $sesion->get("usuario")."<br/>";
                echo '<input type="submit" value="Cerrar sesión">';
                }
                ?>
                            </fieldset>
                        </form>

                        <div id="primeTabla">
                            <table id="tabla1" class="tabla" border="1">
                                <th colspan="4">Mis canciones</th>
                                <tr>
                                    <td><b>Usuario</b></td>
                                    <td><b>Categoría</b></td>
                                    <td><b>Canción</b></td>
                                    <td><b>Reproducir</b></td>
                                </tr>
                                <?php
          $canciones=new FiltrarLista();
         $imagenes=new FiltrarLista();
        
        foreach($canciones->getLista('canciones/') as $key=>$value){
            if($value!="." && $value!=".."){  
           echo "<tr><td>".$canciones->getUsuario($value)."</td><td>"
                   .$canciones->getCategoria($value)."</td><td>"
                   .$canciones->getNombre($value)."</td><td>"
                   . "<audio name='imagenes/".substr($value,0,-3)."jpg' src='canciones/" .$value."' controls type='audio/mpeg'></audio></td></tr>";    
            }
        }
        
        ?>
                            </table>
                        </div>
            </div>
            <div id="derecha">
                <div id="formularioFiltrado">
                    <form method="post" enctype="multipart/form-data">
                        <fieldset>
                            <legend><b>Busca por usuario y categoría</b></legend>
                            Usuario:
                            <input type="text" name="usuario2" placeholder="usuario" size="30" />
                            <br/> Categoría:
                            <input type="text" name="categoria2" placeholder="categoria" size="30" />
                        </fieldset>
                        <input type="submit" name="filtrar" value="Filtrar" />
                    </form>
                    <br/>
                    <div id="imagen"></div>
                    <?php
        
        $usu=  Request::post("usuario2");
        $cat=  Request::post("categoria2");
        
        if($usu!="" || $cat!="") {
            ?>
                        <div id="segunTabla">
                            <table id="tabla2" class="tabla" border="1">
                                <th colspan="4">Resultado búsqueda</th>
                                <tr>
                                    <td><b>Usuario</b></td>
                                    <td><b>Categoría</b></td>
                                    <td><b>Título canción</b></td>
                                    <td><b>Reproducir</b></td>
                                </tr>
                                <?php
        $encontrado=true;
         foreach($canciones->getLista('canciones/') as $key=>$value) {
             if(($usu!="" && $cat!="" && $canciones->getUsuario($value)==$usu && $canciones->getCategoria($value)==$cat) || ($usu!="" && $cat=="" && $canciones->getUsuario($value)==$usu)|| ($cat!="" && $usu=="" && $canciones->getCategoria($value)==$cat) ){
                 echo "<tr><td>".$canciones->getUsuario($value)."</td><td>".$canciones->getCategoria($value)."</td><td>".$canciones->getNombre($value)."</td><td><audio name='imagenes/".substr($value,0,-3)."jpg' src='canciones/".$value."' controls type='audio/mpeg'></audio></td></tr>";  
             }
        }  
       }
         
         ?>

                            </table>

                        </div>
                </div>
            </div>
        </div>

    </body>

    </html>
