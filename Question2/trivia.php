<?php
$triviafiles = "trivia/";
if (isset($_GET["mode"])) {
	
	$mode = strtolower($_GET["mode"]);
	
	$arrayChecker = array("astronomy", "biology", "chemistry", "cs", "culture", "history", "internet", "pokemon", "random");
	
	if ($mode == "categories") {

		$files = glob($dir . '/*.*');
		$file = array_rand($files);

	} else if ($mode == "category") {
		
		if (!isset($_GET["name"])) {
			$categories = scandir($triviafiles);
			$categoryName = $categories[array_rand($categories)];
			for ($x = 0; $x <= 30; $x++) {
				if (!in_array($categoryName, $arrayChecker)){
					$categoryName = $categories[array_rand($categories)];
				}
			}
			
		} else {
			$categoryName = strtolower($_GET["name"]);
		}
		
		$triviafiles = "trivia/$categoryName";

		$questionFile = scandir($triviafiles);
		$randomQuestion = $questionFile[array_rand($questionFile)];
		
		echo $categoryName;
		echo "<br>";
		echo $randomQuestion;
		
		for ($x = 0; $x <= 10; $x++) {
			if(!strpos($categoryName, $randomQuestion)){
				echo "Test";
				$randomQuestion = $questionFile[array_rand($questionFile)];
			}
		}
		$getFileName = file("trivia/$categoryName/$randomQuestion");
		
		echo $randomQuestion;
		echo "<br>";
	
		$question = $getFileName[0];
		
		$answer = $getFileName[1];
		
		echo $question;
		echo "<br>";
		echo $answer;
		
		#echo $questionNum;
		
	}
	} else {
		header("HTTP/1.1 400 Error");
		print("Missing mode query parameter");
		#print($_GET["category"] . " is not a existing category.");
	}
#print(json_encode(array("question" => $question, "answer" => $answer)));
?>
