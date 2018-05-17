function questFilter()
{
	var difficulty = document.getElementById('quest-difficulty').value;
	console.log(difficulty);

	var topic = document.getElementById('quest-topic').value;
	console.log(topic);

	if (difficulty == 'easy') {
		console.log("EASY");
		if (topic == 'loops') {
			console.log("LOOPS");
		} else if (topic == 'arrays') {
			console.log("ARRAYS");
		} else if (topic == 'syntax') {
			console.log("SYNTAX");
		} else if (topic == 'conditionals') {
			console.log("CONDITIONALS");
		} else {
			console.log("ALL");
		}
	} else if (difficulty == 'medium') {
		console.log("MEDIUM");
		if (topic == 'loops') {
			console.log("LOOPS");
		} else if (topic == 'arrays') {
			console.log("ARRAYS");
		} else if (topic == 'syntax') {
			console.log("SYNTAX");
		} else if (topic == 'conditionals') {
			console.log("CONDITIONALS");
		} else {
			console.log("ALL");
		}
	} else if (difficulty == 'hard') {
		console.log("HARD");
		if (topic == 'loops') {
			console.log("LOOPS");
		} else if (topic == 'arrays') {
			console.log("ARRAYS");
		} else if (topic == 'syntax') {
			console.log("SYNTAX");
		} else if (topic == 'conditionals') {
			console.log("CONDITIONALS");
		} else {
			console.log("ALL");
		}
	} else {
		console.log("ALL");
		if (topic == 'loops') {
			console.log("LOOPS");
		} else if (topic == 'arrays') {
			console.log("ARRAYS");
		} else if (topic == 'syntax') {
			console.log("SYNTAX");
		} else if (topic == 'conditionals') {
			console.log("CONDITIONALS");
		} else {
			console.log("ALL");
		}
	}
}