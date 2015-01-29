<?php

	/***************************************/
	// Set month and year
	/***************************************/
	$month = date('n'); #  1 to 12
	$year = date('Y'); # eg. 2015
	$monthName = date('F'); # January through December
	
	if (isset($_GET['months'])) {
		$month = $_GET['months'];
		$monthName = date("F", mktime(0, 0, 0, $month, 10));
	}
	
	if (isset($_GET['years'])) {
		$year = $_GET['years'];
	}
	
	/***************************************/
	// Create calendar
	/***************************************/
	function createCalendar() {
		global $month, $year;
		
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
		
		// Initialize counter
		$cnt = 1;
		
		// Connect to events database
		
		// Create array of dates on which there is an event
			
		// Create list items for days from previous month
		echo "<ul class=\"days\">\n";
		if ($cnt == 1 && $firstDay != 0) {
			for ($i = 0; $i < $firstDay; $i++) {
				echo 	"<li class=\"day other-month\">\n
							<div class=\"date\">-</div>\n
						</li>\n";
			}
		}
		
		// Create remaining list items for first week
		for ($i = $firstDay; $i < 7; $i++) {
			echo	"<li class=\"day\">\n
						<div class=\"date\">$cnt</div>
					</li>\n";
			// If $cnt is equal to day (from database) on which there is an event:
				// Echo <div class="event"><a href="">"Event title</a></div>
			$cnt++;
		}
		echo "</ul>";
	
		// Create remaining weeks
		while ($cnt <= $howManyDays) {
			echo "<ul class=\"days\">\n";
			for ($i = 0; $i <7; $i++) {
				echo	"<li class=\"day\">\n
							<div class=\"date\">$cnt</div>
						</li>\n";
				$cnt++;
				
				// Create list items for days from next month
				if ($cnt == $howManyDays+1 && $lastDay != 6) {
					for ($i = 0; $i < (6 - $lastDay); $i++) {
						echo 	"<li class=\"day other-month\">\n
									<div class=\"date\">-</div>\n
								</li>\n";
					}
					exit();
				}
			}
			echo "</ul>";
		}
	}
	
	
		
	

	
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
				<h1><?php echo $monthName . ' ' . $year; ?></h1>
				<form action="" method="get">
					<?php
						// Make the months array
						$months = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
						
						// Make the years array
						$years = range(date('Y'), date('Y')+5);
						
						// Make the months pull-down menu
						echo '<select name="months">';
						foreach ($months as $monthNum => $monthName) {
							echo "<option value=\"$monthNum\">$monthName</option>\n";
						}
						echo '</select>';
						
						// Make the years pull-down menu
						echo '<select name="years">';
						foreach ($years as $year) {
							echo "<option value=\"$year\">$year</option>\n";
						}
						echo '</select>';
					?>
					<input type="submit" value="Go">
					
					
				</form>
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
				
				<?php echo createCalendar(); ?>
				
			</div><!-- end calendar -->
		</div><!-- end calendar-wrap -->
	</body>
</html>