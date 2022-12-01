 <?php
 class Song {
	public $artist;
	public $title;
	
	
	public function __construct(String $artist, String $title) {
        $this->artist = $artist;
        $this->title = $title;
    }
}
 
 function get_data($year, $month) : String {
	if ($month < 10) {
		$month = "0" .$month;
	}
	
	$ch = curl_init();
	
	curl_setopt($ch, CURLOPT_URL, "https://www.everyhit.com/retros/index.php?page=rchart&y1=$year&m1=$month&y2=$year&m2=$month&sent=1");
	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	
	$response = curl_exec($ch);
	
	$result = "";
	$result .= 'HTTP Status Code: ' .curl_getinfo($ch, CURLINFO_HTTP_CODE) .PHP_EOL;
	$result .= 'Response Body: ' .$response .PHP_EOL;

	curl_close($ch);

	return $result;
 }
 
 function parse_data($data) { 
	$songs = array();
	
	//finds artist and title with </td><td> tag between them
	$pattern = '#(<td>).*(<\/tr>)#';
	preg_match_all($pattern, $data, $matches);
	if ($matches == null){
		return null;
	}
	
	//separates artists and songs
	$pattern2 = '#(?<=<td>).*?(?=<\/td>)#';
	forEach ($matches[0] as $match) {
		preg_match_all($pattern2, $match, $matches2);
		if ($matches2 != null) {
			array_push($songs, new Song($matches2[0][0], $matches2[0][1]));
		}
	}
	return $songs;
 }
 
 function get_video_code($artist, $song) {
	 //TODO: set this up properly
	 
	 //prototype
	switch ($song) {
		case "Way Down": return "weLSA2vekLA";
		case "Magic Fly": return "ZavwtJxmqJI";
		case "Silver Lady": return "yVRb9m06tUQ";
		case "Oxygene Part IV": return "kSIMVnPA994";
		default: return "";
	}
 }
 
 function get_test_data() {
	$songs = array(new Song("Elvis Presley", "Way Down"), new Song("Space", "Magic Fly"), new Song("David Soul", "Silver Lady"), new Song("Jean Michel Jarre", "Oxygene Part IV"));
	return $songs;
 }
?>