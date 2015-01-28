<?php

	// Get the current month and year
	$month = date('n'); #  1 to 12
	$year = date('Y'); # eg. 2015

	// Verify which weekday is the first day of the month
	$firstDay = date('w', mktime(0, 0, 0, $month, 1, $year)); # 0 (for Sunday) to 6 (for Saturday)
	
	// Verify how many days there are in the month
	if ($month == 12) {
		$howManyDays = date('j', mktime(0, 0, 0, 1, 0, $year+1));
	} else {
		$howManyDays = date('j', mktime(0, 0, 0, $month+1, 0, $year));
	}
	
	// Verify which weekday is the last day of the month
	$lastDay = date('w', mktime(0, 0, 0, $month, $howManyDays, $year));
	
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
						// Initialize counter
						$cnt = 1;
						
						// Create all <li class="day other-month">
						if ($cnt == 1 && $firstDay != 0) {
							for ($i = 0; $i < $firstDay; $i++) {
								echo 	"<li class=\"day other-month\">\n
											<div class=\"date\">-</div>\n
										</li>";
							}
						}
						
						// Create remaining list items for first week
						for ($i = $firstDay; $i < 7; $i++) {
							echo	"<li class=\"day\">\n
										<div class=\"date\">$cnt</div>
									</li>";
							$cnt++;
						}
					?>
				</ul>
				
				<?php
					while ($cnt <= $howManyDays) {
						echo "<ul class=\"days\">\n";
						for ($i = 0; $i <7; $i++) {
							echo	"<li class=\"day\">\n
										<div class=\"date\">$cnt</div>
									</li>";
							$cnt++;
							if ($cnt == $howManyDays+1 && $lastDay != 6) {
								for ($i = 0; $i < (6 - $lastDay); $i++) {
									echo 	"<li class=\"day other-month\">\n
												<div class=\"date\">-</div>\n
											</li>";
								}
								exit();
							}
						}
						echo "</ul>";
					}
				?>
				
			</div><!-- end calendar -->
		</div><!-- end calendar-wrap -->
	</body>
</html>