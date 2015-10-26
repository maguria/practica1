<?php

require './clases/AutoCarga.php';

$usu= Request::post("usuario1");
$sesion=new Session();
$sesion->set("usuario",$usu);


header("Location:index.php");
