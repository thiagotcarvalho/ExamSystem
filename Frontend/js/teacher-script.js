// When the user scrolls the page, execute myFunction 
window.onscroll = function() {myFunction()};

// Get the navbar
var navbar = document.getElementById("navbar");

// Get the offset position of the navbar
var sticky = navbar.offsetTop;

// Add the sticky class to the navbar when you reach its scroll position. Remove "sticky" when you leave the scroll position
function myFunction() {
  if (window.pageYOffset >= sticky) {
    navbar.classList.add("sticky")
  } else {
    navbar.classList.remove("sticky");
  }
}

function questionAdd()
{
    var i = 0;
    var myEle = document.getElementById("0");

    while(myEle != null) {
        if (document.getElementById(i).checked == true) {
            var labels = document.getElementsByTagName("label");
            var qID = document.getElementById(i).value;

            var text = [];
            for (var j = 0; j < labels.length; j++) {
                var label = labels[j];
                if (label.getAttribute("for") == i) {
                    // console.log(label.innerText);
                    var appendQuestion = label.innerText;
                    document.getElementById("exam-preview").innerHTML += '<li>' + appendQuestion + '</li><input type="text" name="points[]" placeholder="# of points. i.e. 10" required>';

                    document.getElementById("question-id").innerHTML += '<input type="hidden" name="questions[]" value="' + qID + '">';
                }
            }
        }
        i++;
        myEle = document.getElementById(i);
    }
}

function filterQuestions()
{   
    var difficulty = document.getElementById('quest-difficulty').value.toUpperCase();
    var topic = document.getElementById('quest-topic').value.toUpperCase();
    var tr = document.getElementsByTagName("tr");

    for (var i = 0; i < tr.length; i++) {
        var td = tr[i].getElementsByTagName("td")[0];
        var filterOption = document.getElementById(i).className.toUpperCase().split(" ");
        var questionDifficulty = filterOption[0];
        var questionTopic = filterOption[1];

        if (questionDifficulty == difficulty && questionTopic == topic) {
            tr[i].style.display = "";
        } else if (difficulty == "ALL" && questionTopic == topic) {
            tr[i].style.display = "";
        } else if (questionDifficulty == difficulty && topic == "ALL") {
            tr[i].style.display = "";
        } else if (difficulty == "ALL" && topic == "ALL") {
            tr[i].style.display = "";
        } else {
            tr[i].style.display = "none";
        }
    }
}