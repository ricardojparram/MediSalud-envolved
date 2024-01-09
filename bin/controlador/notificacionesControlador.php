<?php
	use component\initcomponents as initcomponents;
	use component\header as header;
	use component\menuLateral as menuLateral;
	use modelo\notificaciones;

	$model = new notificaciones();

	if(isset($_POST['notificacionRegistrar'])){
		$model->registrarNotificaciones();
	}

	if (isset($_POST['notificaciones'])) {
		$model->getNotificaciones();
	}

	if(isset($_POST['notificacionVista'], $_POST['notificationId'])) {
		$model->notificacionVista($_POST['notificationId']);
	}

	if (isset($_POST['pedidoNotificacion'])) {
		$model->actualizarNotificacion($_POST['mensaje']);
	}

	die("<script> window.location = '?url=login' </script>");

?>