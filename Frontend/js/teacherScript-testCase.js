function addTestCase()
{
	var form = document.getElementById('add-quest');
	var row = document.createElement("DIV");
	var col = document.createElement("DIV");
	var textarea = document.createElement("TEXTAREA");

	document.form.appendChild(row);
	document.row.appendChild(col);
	document.col.appendChild(textarea);

	var attClassRow = document.createAttribute("class");
	attClassRow.value = "row";
	var attClassCol = document.createAttribute("class");
	attClassCol.value = "col";
	var attPlaceHolderTextarea = document.createAttribute("placeholder");
	attIdTextarea.value = "Test";

	row.setAttributeNode(attClassRow);
	col.setAttributeNode(attClassCol);
	textarea.setAttributeNode(attPlaceHolderTextarea);



}