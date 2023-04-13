<!DOCTYPE html>
<html>
<head>
	<title>Exemplo de Require Once</title>
</head>
<body>

	<?php
		// Incluir um arquivo PHP com uma função
		require_once 'minhas_funcoes.php'; 

		// Chamar a função para exibir uma mensagem
		echo get_message();
	?>

</body>
</html>