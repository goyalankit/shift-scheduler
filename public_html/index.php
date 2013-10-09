<?php

	require_once(realpath(dirname(__FILE__) . "/../resources/config.php"));

	require_once(LIBRARY_PATH . "/templateFunctions.php");

	
	
	$setInIndexDotPhp = "This is cool.";
	
	// Must pass in variables (as an array) to use in template
	$variables = array(
		'setInIndexDotPhp' => $setInIndexDotPhp
	);
	
	renderLayoutWithContentFile("home.php", $variables);

?>