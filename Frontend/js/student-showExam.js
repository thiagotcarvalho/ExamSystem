function loadExam()
{
	document.getElementById("examButton").style.display = "none";

	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var myObj = JSON.parse(this.responseText);
			examForm = document.getElementById("exam-two");

			var questionNum = 0;
			for (var i = 0; i < myObj.length; i+=3) {
				examForm.innerHTML = examForm.innerHTML + '<div class="row">'+ (questionNum+1) + ') ' + myObj[i] +' (points: '+ myObj[i+2] +')</div>'
									 + '<div class="row"><textarea name="'+ myObj[i+1] 
									 +'" rows="4" cols="50" placeholder="Insert Answer Here" required></textarea></div>';
				questionNum++;
			}
			examForm.innerHTML = examForm.innerHTML 
								 + '<div class="row"><button class="button shadow"'
								 + ' type="submit" formid="exam-two" name="submitExam">Submit Exam</button></div>';
		}
	};
	xhttp.open("GET", "https://web.njit.edu/~vac33/PreStudent.php", true);
	xhttp.send();
}