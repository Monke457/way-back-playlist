function update_month() {
	var year = document.getElementById('year').value;
	var month_picker = document.getElementById('month');
	if (year == 1952) {
		for (i = 0; i < month_picker.length; i++) {
			if (month_picker[i].value < 11) {
				month_picker[i].disabled = true;
			}
		}
	} else {
		for (i = 0; i < month_picker.length; i++) {
			month_picker[i].disabled = false;
		}
	}
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




