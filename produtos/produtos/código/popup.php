<?php
session_start();
if (isset($_SESSION['PRODUTOESTIMADO']))
	$keys = array_keys($_SESSION['PRODUTOESTIMADO']);
/*$usuario = $_SESSION["USUARIOLOGADO"];*/
$usuario = "Fábio Palmela de Oliveira";
?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="UTF-8">
<?php
echo "<title>Lista Usuario</title>";
?>

<link rel="stylesheet" href="css/style.css" >

</head>

<body>
<h1 align="center">PRODUTOS ADICIONADOS</h1>
	<div id="popup">
		<form><br>
			<?php
			if (!empty($keys)) {
				echo "<p>";
				echo "<select class='listapop' name='POT' >";
				foreach($keys as $key){
					echo "<option value='optionPopup'>" . $key .  "</option>";
				}
				echo "</select>";
				echo "</p>";
			}else{
				echo "Nenhum produto adicionado";
			}
			?><br>
			<div>
				<br><br><a href='Controle/Carrinho.php'><input class='button btnCar listapop' style='cursor: pointer; float: right;' value='Confirmar' type='button'></a><br><br>
				<a href='Controle/Carrinho.php'><input class='button btnCar listapop' style='cursor: pointer; float: right;' value='Limpar Lista' type='button'></a>
			</div>
		</form>
	</div>

</body>
</html>    