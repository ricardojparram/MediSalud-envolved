<?php
	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\notificaciones;

	$model = new notificaciones();

	if(isset($_POST['notificacion'])){
		$model->getNotificaciones();
	}

	die("<script> window.location = '?url=login' </script>");

?>