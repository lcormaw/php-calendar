<?php

	// Get the current day, weekday, month and year
	$day = date('j'); # 1 to 31
	$weekday = date('w'); # 0 (for Sunday) to 6 (for Saturday)
	$month = date('n'); #  1 to 12
	$year = date('Y'); # eg. 2015
	
	// Check if $year is a leap year
	$leap = date('L'); #returns 1 if leap
	
	// Verify which weekday is the first day of the month
	$firstDay = date('w', mktime(0, 0, 0, $month, 1, $year)); # 0 (for Sunday) to 6 (for Saturday)

?>