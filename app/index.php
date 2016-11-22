<?php 
	include 'init.php';
	include_once ENGINE_PATH.DS.'Router.php';
	$router = new Router();
?>
<html>
<head>
<title>SAND BOX</title>
</head>
<body>
<?php 
$action = $router->getAction();
$controller = $router->getController();
$controller->$action();
?>
	</body>
</html>
