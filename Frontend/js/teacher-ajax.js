/* dynamically display questions */
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var myObj = JSON.parse(this.responseText);
		qBank = document.getElementById("questBank");

		for (var i = 0; i < myObj.length; i++) {
			qBank.innerHTML = qBank.innerHTML + '<tr><td><input type="checkbox" id="'
							  + i +'" class="'+ myObj[i].Difficulty +' '+ myObj[i].Topic +'" value="'+ myObj[i].ID 
							  +'"/><label for="'+ i +'">' + myObj[i].Question + '</label></td><td>'+ myObj[i].Difficulty 
							  +'</td><td>'+ myObj[i].Topic +'</td></tr>';
		}
	}
};
xhttp.open("GET", "grabQuestions.php", true);
xhttp.send();
/* end */