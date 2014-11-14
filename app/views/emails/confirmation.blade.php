<html>
	<head>
		 <style type="text/css">
		   .btn {
			   	background-color:#039be5;
			   	border: 1px solid #1e3650;
			   	border-radius:4px;
			   	color: #ffffff;
			   	display:inline-block;
			   	font-family:sans-serif;
			   	font-size:13px;
			   	font-weight:bold;
			   	line-height:40px;
			   	text-align:center;
			   	text-decoration:none;
			   	width:300px;
			   	-webkit-text-size-adjust:none;mso-hide:all;
		    }
		   .btn:hover {
		   		background-color:#03a9f4;
		   }
		</style>
	</head>
	<body>
		<div>
			Ciao {{ $name }},<br />
			benvenuto in Oboli!<br />
			<br />
			<a class="btn" href="{{ $link }}">Clicca per confermare il tuo account</a><br />
			<br />
			O clicca su questo link: </br>
			<a href="{{ $link }}">{{ $link }}</a>


		</div>
	</body>
</html>