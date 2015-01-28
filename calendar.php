<?php

	// Set timezone
	
	
	// Get the current day, weekday, month and year
	$day = date('j'); # 1 to 31
	$weekday = date('w'); # 0 (for Sunday) to 6 (for Saturday)
	$month = date('n'); #  1 to 12
	$year = date('Y'); # eg. 2015
	
	// Check if $year is a leap year
	$leap = date('L'); #returns 1 if leap
	
	// Verify which weekday is the first day of the month
	$firstDay = date('w', mktime(0, 0, 0, $month, 1, $year)); # 0 (for Sunday) to 6 (for Saturday)
	
	// Verify how long is the month
	if ($month == 12) {
		$lastDay = date('j', mktime(0, 0, 0, 1, 0, $year+1));
	} else {
		$lastDay = date('j', mktime(0, 0, 0, $month+1, 0, $year));
	}
	
	$lastMonthDay = date('w', mktime(0, 0, 0, $month, $lastDay, $year));
	
?>

<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Responsive PHP Calendar with Events</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="css/style.css" type="text/css">
	</head>
	<body>
		<div id="calendar-wrap">
			<!-- Make header into a dropdown menu -->
			<header>
				<h1><?php echo date('F') . ' ' . $year; ?></h1>
			</header>
			
			<div id="calendar">
				<ul class="weekdays">
					<li>Sunday</li>
					<li>Monday</li>
					<li>Tuesday</li>
					<li>Wednesday</li>
					<li>Thursday</li>
					<li>Friday</li>
					<li>Saturday</li>
				</ul>
				
				<ul class="days">
					<?php
						// Create all <li class="day other-month">
						if ($firstDay != 0) {
							for ($i = 0; $i < $firstDay; $i++) {
								echo 	"<li class=\"day other-month\">\n
											<div class=\"date\">-</div>\n
										</li>";
							}	
						}
						
					?>
					
					<?php
						// Create <li class="day"> for first week
						$cnt = 1;
						for ($i = $firstDay; $i < 7; $i++) {
							echo	"<li class=\"day\">\n
										<div class=\"date\">$cnt</div>
									</li>";
							$cnt++;
						}
						
					?>
				</ul>
				
				<?php
					
					while ($cnt <= $lastDay) {
						echo "<ul class=\"days\">\n";
						for ($i = 0; $i <7; $i++) {
							echo	"<li class=\"day\">\n
										<div class=\"date\">$cnt</div>
									</li>";
							$cnt++;
							if ($cnt == $lastDay+1 && $lastMonthDay != 6) {
								for ($i = 6 - $lastMonthDay; $i < 7; $i++) {
									echo 	"<li class=\"day other-month\">\n
												<div class=\"date\">Empty</div>\n
											</li>";
								}
							}
						}
						echo "</ul>";
					}
				
				?>
				
				
				
				
			</div><!-- end calendar -->
		</div><!-- end calendar-wrap -->
	</body>
</html>