<?php 

 namespace modelo;

 use config\connect\DBconnect as DBconnect;


 class inicio extends DBconnect{

  public function __construct(){
  	parent::__construct();
  } 

  public function mostrarCatalogo(){
  die('Hola');
  $query = '';

  }

 }




?>