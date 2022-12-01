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