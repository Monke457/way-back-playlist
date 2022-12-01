<!DOCTYPE html>
<html lang="en">
<?php 
	include("header.php");
	include("php/scraper.php");
?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <title>Way Back Playlist</title>
</head>
<script src="js/script.js"></script>
<body>
	<div class="content">
		<?php 
			/*
			$data = get_data($_POST['year'], $_POST['month']); 
			$songs = parse_data($data);
			*/
			
			$songs = get_test_data();
			
			//accordion
			forEach ($songs as $song) {
				//element with youtube player
				//echo $song->artist .": " .$song->title ."<br>";
				$code = get_video_code($song->artist, $song->title);
				echo "<button class='accordion'>$song->artist - $song->title</button>";
				echo "<div class='panel'>";
				echo "<iframe class='video' src='https://www.youtube.com/embed/$code' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
				echo "</div>";
			}
		?>
		
	</div>
</body>
<script>
	var acc = document.getElementsByClassName("accordion");
	var i;

	for (i = 0; i < acc.length; i++) {
	  acc[i].addEventListener("click", function() {
		this.classList.toggle("active");
		var panel = this.nextElementSibling;
		if (panel.style.maxHeight) {
		  panel.style.maxHeight = null;
		} else {
		  panel.style.maxHeight = "315px";
		} 
	  });
	}
</script>
</html>