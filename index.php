<?php

	require("classes.php");

	$videos = canalYoutube::getVideos();

	$videosQueFaltam = array_filter($videos, function($k) { return $k->link == "#"; });

	/*$i = 1;

	$linkVazio = "#";

	foreach($videos as $cadaVideo){

		if($cadaVideo->link == $linkVazio){

			$videosQueFaltam = $i++;
		}
	}*/

?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset="utf-8">
		<title>Desafio1</title>
		<link rel="stylesheet" type="text/css" href="estilo.css">
	</head>
	<body>

		<div class="cabecalho">
			<h1>#Desafio100Vídeos</h1>
			<h2>Faltam <?php echo count($videosQueFaltam); ?> </h2>
		</div>

		<?php foreach($videos as $video): ?>

				<a target="_blank" href=" <?php echo $video->link ?> "> <img src=" <?php echo $video->image ?> "> </a>
		
		<?php endforeach ?>

	</body>
</html>