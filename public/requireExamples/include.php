<!DOCTYPE html>
<html>
<head>
	<title>Exemplo de Include</title>
</head>
<body>

	<?php

       //warning
		// Incluir um arquivo PHP com um array de dados
		include 'dados.php';

		// Usar o array para exibir uma lista na página
		echo "<ul>";
		foreach ($dados as $item) {
			echo "<li>$item</li>";
		}
		echo "</ul>";
	?>

</body>
</html>