<!DOCTYPE html>
<html>
<head>
	<title>Exemplo de Require</title>
</head>
<body>

	<?php
        // Fatal Error
		// Incluir um arquivo PHP com uma variável
		require 'config.php'; 

		// Usar a variável para definir o título da página
		echo "<h1>$page_title</h1>";
	?>

</body>
</html>