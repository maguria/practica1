<?php

require './clases/AutoCarga.php';

$usuario=Request::post("usuario1");
$categoria=  Request::post("categoria1");

 
$sesion=new Session();

header("Location:index.php");

    $arch= new FileUpload("archivo");
    $imagen=new FileUpload("imagen");

    $arch->setDestino("canciones/");
    $imagen->setDestino("imagenes/");
    
    //Aquí le decimos que si la canción contiene guiones bajos los sustituya por &

    if(substr_count($arch->getNombre(), "_")>0){
    $arch->setNombre(str_replace("_", "&", $arch->getNombre()));
     $arch->setNombre(str_replace("-", "&", $arch->getNombre()));
    }

    $arch->setNombre($sesion->get("usuario")."_".$categoria."_".$arch->getNombre());
    $imagen->setNombre($arch->getNombre());


    $arch->setPolitica(FileUpload::RENOMBRAR);
    $imagen->setPolitica(FileUpload::RENOMBRAR);



    $arch->upload();
    $imagen->upload();
        
     header("Location:index.php");
