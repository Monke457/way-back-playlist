<!DOCTYPE html>
<html lang="en">
<?php 
	include("header.php");
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
		<p class="instructions">Enter a date and generate a playlist!</p>
		<form action="playlist.php" method="post">
			<select name="year" id="year" onchange="update_month()">
				<?php 
					for ($i = 1952; $i < 2011; $i++) {
						echo "<option value=$i" .($i == 1977 ? " selected" : "") .">$i</option>";
					}
				?>
			</select><br>
			
			<select name="month" id="month">
				<?php 
					for ($i = 1; $i < 13; $i++) {
						echo "<option value=$i" .($i == 9 ? " selected" : "") .">" .date('F', mktime(0, 0, 0, $i, 10)) ."</option>";
					}
				?>
			</select><br>
			<button type="submit" id="submit">Take me back!</button>
		</form>
	</div>
</body>
</html>