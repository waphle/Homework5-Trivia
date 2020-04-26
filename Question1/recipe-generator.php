<?php
# Remember to set this at the top of your PHP files!
error_reporting(E_ALL);

# Example Output:

# Mowgli's Muffin
# Recipe:
# In a bowl, mix:
#   1 Oreo
#   1 gallon of Water
#   1 oz of Green peas
#   1 Lentil
#   1 Ice cube
#
# Cook for 6 minutes and serve!

# 1. Check whether the correct parameter(s) are set, printing a helpful error message
# otherwise.

$name = $_GET["name"];

generate_recipe($name);

# 2. Remember to set the content-type for each web service! This web service outputs plain txt.

# Finish this "main function" to generate the entire recipe. Pass in your query parameter value
# to this function. Use helper functions to factor out meaningful behavior!
function generate_recipe($name) {
	# 3. Generate a recipe name with the first letter in the name parameter using the file in foods/
	# corresponding to the first letter. Print the recipe name on a new line.
	
	# 4. Print intermediate text to introduce directions and ingredient list.

	# 5. Generate a list of ingredients for each letter in the name (each on a new line)
	
	#Recipe Name
	#echo $name;
	#echo "'s ";
	#generate_recipe_name($name);
	#FINAL OUTPUT INTRO
	#echo "<br><br>";
	#output_ingredient_intro();
	#generate_ingredients($name);

	# 6. Print final step based on name length (see spec).

	$myfile = fopen("webdictionary.txt", "w") or die("Unable to open file!");
	
	$txt = $name;
	echo $txt;
	fwrite($myfile, $txt);
	
	$txt = "'s ";
	echo $txt;
	fwrite($myfile, $txt);
	
	$txt = generate_recipe_name($name);
	echo "<br>";
	fwrite($myfile, $txt);
	
	$txt = output_ingredient_intro();
	fwrite($myfile, $txt);
	
	$letters = str_split($name);
	for ($x = 0; $x < count($letters); $x++) {
		echo "<br>";
		$txt = generate_ingredients($name, $x);
		fwrite($myfile, $txt);
	}
	
	echo fread($myfile,filesize("webdictionary.txt"));
	
	fclose($myfile);
	
	#echo file_get_contents("webdictionary.txt");

}


function generate_recipe_name($name) {
	
	$firstLetter = strtolower(substr($name, 0,1));
	
	$getFileName = file("foods/$firstLetter.txt");
	
	$line = $getFileName[rand(0, count($getFileName) - 1)];
	
	echo $line;
	
	return $line;
	
}

function generate_ingredients($name, $x) {
	
	$letters = str_split($name);
	
	if ($x == 0){
		
		$letter = strtolower($letters[$x]);
		
	} else{
		$letter = $letters[$x];
	}
	
	$getFileName = file("ingredients/$letter.txt");
	
	$line = $getFileName[rand(0, count($getFileName) - 1)];
	
	echo $line;
	
	return $line;
}

# (PROVIDED HELPER FUNCTIONS)
# ==================================================================================== #

# Outputs intermediate text in a recipe, introducing directions and ingredients.
function output_ingredient_intro() {
	echo "<br>";
	echo "Directions:\n\n<br>";
	echo "In a bowl, mix:\n";
	return "\nDirections:\nIn a bowl, mix:\n";
}

# Returns a random line from the txt file corresponding to the letter and folder name.
# Pre: $letter is a single alphabetical letter
function get_random_line_from_letter($folder_name, $letter) {
	# Remember that file returns an array of all of the lines in a file
	# implement me (replace "" with the necessary value to get the file as an array of lines)!
	$choices = file("");

	# array_rand is a function that returns a random element from an array
	return $choices[array_rand($choices)];
}
?>
