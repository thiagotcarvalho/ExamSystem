var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function() {
	if (this.readyState == 4 && this.status == 200) {
		var myObj = JSON.parse(this.responseText);
		console.log(myObj);

		examGrade = document.getElementById("examGrade");
		for (var i = 0; i < myObj.length; i++) {
			console.log(i + ' ' + myObj[i][0]);
			// examGrade.innerHTML = examGrade.innerHTML + '<div id="question'+ myObj[i] +'"></div>';

			if (myObj[i][0] == 1) {
				examGrade.innerHTML = examGrade.innerHTML + '<textarea rows="4" cols="50" id="'+ i 
					+'">The function name was correct!\nYou got '+ myObj[i][1] +' test cases correct.</textarea>';
			} else if (myObj[i][0] == 0) {
				examGrade.innerHTML = examGrade.innerHTML + '<textarea rows="4" cols="50" id="'+ i 
					+'">The function name was incorrect!\nYou got '+ myObj[i][1] +' test cases correct.</textarea>';
			} else {
				var questionNum = 1;
				for (var j = 0; j < myObj[i].length; j++) {
					if (j == myObj[i].length - 1) {
						examGrade.innerHTML = examGrade.innerHTML + "<h3>Your total grade was: "+ myObj[i][j] +"</h3>";
					} else {
						examGrade.innerHTML = examGrade.innerHTML + "<h4>You got "+ (myObj[i][j] * 100) +" points for question " 
							+ questionNum +"</h4>";
						questionNum++;
					}
				}
			}
		}
		examGrade.innerHTML = examGrade.innerHTML + '<input type="submit" value="Release Grade" name="releaseGrade">';
	}
};
xhttp.open("GET", "https://web.njit.edu/~vac33/StudentAction.php", true);
xhttp.send();