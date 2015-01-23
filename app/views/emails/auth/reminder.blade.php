<!DOCTYPE html>
<html lang="it-It">
	<body>
		<h2>Oboli - Crea una nuova password</h2>
		<div>
			<a href="{{ URL::to('password/reset', array($token)) }}">Clicca qui</a> per creare una nuova password.
		</div>
	</body>
</html>
