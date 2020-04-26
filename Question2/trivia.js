"use strict";
(function() {
	let currentCategory;
	var alreadySelected = false;

	window.onload = function() {
		$("view-all").onclick = fetchCategories;
		$("next").onclick = questionOrAnswer;
	};

	function fetchCategories() {
		
		// use fetch HTTP request to get the categories
		// call displayCategories
	
		if (alreadySelected == false){ 
			document.getElementById("category-view").style.display = 'block';
			document.getElementById("categories-heading").style.display = 'block';
			document.getElementById("question-view").style.display = 'block';
			
			let hrx = new XMLHttpRequest();  
			hrx.open("GET", "trivia.php?mode=categories");
			hrx.onload = displayCategories;  
			hrx.send();  
			alreadySelected = true;
		}
		
	}

	function questionOrAnswer() {
		
		// your code here
		
		document.getElementById("card").style.display = 'block';
		
		if (document.getElementById("Question")){
			var Question = document.getElementById('Question');
			Question.remove(); 
		}
		showTrivia();
		
	}


	// leave the showTrivia function as it is.
	function showTrivia() {
		let url = "trivia.php?mode=category";
		if (currentCategory) {
			url += "&name=" + currentCategory;
		}
		fetch(url)
		.then(checkStatus)
		.then(JSON.parse)
		.then(displayQuestion);
	}

	function displayQuestion(response) {
		
		//your code here
		
		
		var outside = document.getElementById("card");
		var temp = document.createElement("id"); 
		temp.id = "Question";
		var p = document.createElement("p");
		p.appendChild(document.createTextNode(response));
		temp.appendChild(p);
		outside.appendChild(temp);
		
		
	}

	function displayCategories() {
		
		if (this.readyState == 4 && this.status == 200) {
			var myArr = JSON.parse(this.responseText);
			for (var i = 0; i < myArr.length; i++) {
				var ul = document.getElementById("categories");
				var li = document.createElement("li");
				var temp = document.createElement("id"); 
				temp.id = myArr[i];
				li.appendChild(document.createTextNode(myArr[i]));
				temp.appendChild(li);
				ul.appendChild(temp);
			}
		}
		
	}

	/// provided helper functions don't change.
	function $(id) {
		return document.getElementById(id);
	}

	function qsa(el) {
		return document.querySelectorAll(el);
	}

	function checkStatus(response) {
		if (response.status >= 200 && response.status < 300 ||
		response.status == 0) {
		return response.text();
	} else {
		return Promise.reject(
		new Error(response.status + ": " + response.statusText));
		}
	}
})()
