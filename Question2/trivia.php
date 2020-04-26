<?php
$triviafiles = "trivia/";
if (isset($_GET["mode"])) {
	
	$mode = strtolower($_GET["mode"]);
	
	$cat = array("astronomy", "biology", "chemistry", "computerscience", "culture", "history", "internet", "pokemon", "random");
	
	if ($mode == "categories") {
		
		echo(json_encode($cat));
		
		#echo($arrayChecker);
		
	} else if ($mode == "category") {
		
		if (!isset($_GET["name"])) {
			$categories = scandir($triviafiles);
			$categoryName = $categories[array_rand($categories)];
			for ($x = 0; $x <= 30; $x++) {
				if (!in_array($categoryName, $cat)){
					$categoryName = $categories[array_rand($categories)];
				}
			}
			
		} else {
			$categoryName = strtolower($_GET["name"]);
		}
		
		$triviafiles = "trivia/$categoryName";

		$questionFile = scandir($triviafiles);
		$randomQuestion = $questionFile[array_rand($questionFile)];
		
		
		for ($x = 0; $x <= 20; $x++) {
			if($randomQuestion == "." or $randomQuestion == ".."){
				$randomQuestion = $questionFile[array_rand($questionFile)];
			}
		}
		$getFileName = file("trivia/$categoryName/$randomQuestion");
		
	
		$question = $getFileName[0];
		
		$answer = $getFileName[1];
		
		#echo $question;
		#echo "<br>";
		#echo $answer;
		
		#echo $questionNum;
		
		$finalArray = array($question,$answer);
		
		echo(json_encode($finalArray));
		
	}
	} else {
		header("HTTP/1.1 400 Error");
		print("Missing mode query parameter");
		print($_GET["category"] . " is not a existing category.");
	}
?>
