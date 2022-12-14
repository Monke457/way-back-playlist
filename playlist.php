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
			$data = get_data($_POST['year'], $_POST['month']); 
			$songs = parse_data($data);

			//accordion
			for ($i = 0; $i < count($songs); $i++) {
				//element with youtube player	
				//$code = get_video_code($song);
				
				$song = $songs[$i];
				$artist = $song->artist;
				$title = $song->title;
				$term = str_replace('\'', '', $artist .' ' .$title);
				$term = str_replace('"', '', $term);
				
				echo "<button class='accordion' onclick='get_video(\"$term\", $i)'>$artist - $title</button>";
				echo "<div class='panel'>";
				echo "<iframe class='video empty' id='$i' src='' title='YouTube video player' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe>";
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

	function get_video(searchTerm, id) {
		var el = document.getElementById(id);
		if (el.classList.contains('empty')) {
			const YOUTUBE_API_KEY = 'AIzaSyDirInrRS94Dyz2tq2hMQaYkyeENzqjmEM';
			var url = 'https://www.googleapis.com/youtube/v3/search?part=snippet&maxResults=1&q=' + searchTerm + '&key=' + YOUTUBE_API_KEY;
			fetch(url)
			.then(response => response.json())
			.then(data => {  
				el.src = 'https://www.youtube.com/embed/' + data.items[0].id.videoId;
			});
			el.classList.remove('empty');
		}
	}
</script>
</html>