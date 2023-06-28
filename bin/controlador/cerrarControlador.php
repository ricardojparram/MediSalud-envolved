<?php 

if(isset($_SESSION['cedula'])){
	session_destroy();
	die('<script> window.location = "?url=login" </script>');
	
}

?>