<?php

	/***************************************/
	// Set month and year
	/***************************************/
	$month = date('n'); 
	$year = date('Y'); 
	$monthName = date('F');
	
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
	function testCalendar($month, $year) {
		
		// Verify on which weekday to start and end the calendar and how long the month is
		$firstDay = date('w', mktime(0, 0, 0, $month, 1, $year));
	
		if ($month == 12) {
			$howManyDays = date('j', mktime(0, 0, 0, 1, 0, $year+1));
		} else {
			$howManyDays = date('j', mktime(0, 0, 0, $month+1, 0, $year));
		}
		
		$lastDay = date('w', mktime(0, 0, 0, $month, $howManyDays, $year));
		
		$cnt = 1;
		$calendar = "<ul class=\"days\">\n";
		
		
		
		
		// Create list items for days for the first week
		
		if ($firstDay) {
			for ($i = 1; $i <= $firstDay; $i++) {
				$calendar .= 	"<li class=\"day other-month\">\n
									<div class=\"date\">&nbsp;</div>\n
								</li>\n";
			}
			
			$remainingDays = 7 - $firstDay;
			
			for ($i = 1; $i <= $remainingDays; $i++) {
				$calendar .= 	"<li class=\"day\">\n
									<div class=\"date\">$cnt</div>\n
								</li>\n";
				$cnt++;
			}
			
			$calendar .= "</ul>\n";
		}
		
		// Create list items for the rest of the month
		while ($cnt <= $howManyDays) {
			
			$calendar .= "<ul class=\"days\">\n";
			
			for ($i = 0; $i <7; $i++) {
				$calendar .=	"<li class=\"day\">\n
									<div class=\"date\">$cnt</div>\n";
					
				if (isset($events)) {
					foreach ($events as $event) {
							if ($event['dayStart'] == $cnt) {
								echo ${'display' . $event['id']};
							}
					}	
				}
					
				$calendar .= "</li>\n";
				$cnt++;
				
				// Create list items for days from next month
				if ($cnt == $howManyDays+1 && $lastDay != 6) {
					for ($i = 0; $i < (6 - $lastDay); $i++) {
						$calendar .=	"<li class=\"day other-month\">\n
											<div class=\"date\">&nbsp;</div>\n
										</li>\n";
					}
					break;
				}
			}
			
			$calendar .= "</ul>\n";
		}
		
		echo $calendar;
		
	}
	
	
	
	
	
	
	
	
	/***************************************/
	// Create calendar
	/***************************************/
/*	function createCalendar() {
		global $month, $year, $firstDay, $howManyDays, $lastDay;
		$cnt = 1;
		
		// Create list items for days from previous month
		echo "<ul class=\"days\">\n";
		if ($cnt == 1 && $firstDay != 0) {
			for ($i = 0; $i < $firstDay; $i++) {
				echo 	"<li class=\"day other-month\">\n
							<div class=\"date\">&nbsp;</div>\n
						</li>\n";
			}
		}
		
		// Connect to events database
		try {
			$pdo = new PDO('mysql:host=localhost;dbname=events', 'eventadmin', 'mypassword');
			$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$pdo->exec('SET NAMES "utf8"');
		} catch (PDOException $e) {
			$output = "Unable to connect to the database server: " . $e->getMessage();
			echo $output;
			exit();
		}
		
		// Fetch events
		try {
			$sql = 	"SELECT id, title, dayStart, dayEnd FROM eventdate
					WHERE month = $month AND year = $year";
			$result = $pdo->query($sql);
		} catch (PDOException $e) {
			$error = "Error fetching events: " . $e->getMessage();
			echo $error;
			exit();
		}

		foreach ($result as $row) {
		$events[] = array(
						"id" => $row["id"],
						"title" => $row["title"],
						"dayStart" => $row["dayStart"],
						"dayEnd" => $row["dayEnd"]
					);
		
		}
		
		if (isset($events)) {
			// Create div for each event
			foreach ($events as $event) {
				$id = $event['id'];
				${'display' . $id} = "<div class=\"event\">\n";
				${'display' . $id} .= "<div class=\"event-desc\">\n";
				${'display' . $id} .= "<a href=\"?event" .$id . "\">" . $event['title'] . "</a>\n";
				${'display' . $id} .= "</div>\n";
				${'display' . $id} .= "</div>\n";
			}
		}
			
		
		
		
		// Create remaining list items for first week
		for ($i = $firstDay; $i < 7; $i++) {
			echo	"<li class=\"day\">\n
					<div class=\"date\">$cnt</div>";
			
			if (isset($events)) {
				foreach ($events as $event) {
						if ($event['dayStart'] == $cnt) {
							echo ${'display' . $event['id']};
						}
				}	
			}
						
					
			echo 	"</li>\n";
			$cnt++;
		}
		echo "</ul>";
	
		// Create remaining weeks
		while ($cnt <= $howManyDays) {
			echo "<ul class=\"days\">\n";
			for ($i = 0; $i <7; $i++) {
				echo 	"<li class=\"day\">\n
						<div class=\"date\">$cnt</div>";
					
				if (isset($events)) {
				foreach ($events as $event) {
						if ($event['dayStart'] == $cnt) {
							echo ${'display' . $event['id']};
						}
				}	
			}
					
				echo 	"</li>\n";
				$cnt++;
				
				// Create list items for days from next month
				if ($cnt == $howManyDays+1 && $lastDay != 6) {
					for ($i = 0; $i < (6 - $lastDay); $i++) {
						echo 	"<li class=\"day other-month\">\n
									<div class=\"date\">&nbsp;</div>\n
								</li>\n";
					}
					exit();
				}
			}
			echo "</ul>";
		}
	}
*/	
	/***************************************/
	// Create pull-down menus
	/***************************************/
	function changeCalendar() {
		$months = array(1 => 'January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		
		$years = range(date('Y'), date('Y')+5);
		
		$menu = '<select name="months">';
		foreach ($months as $monthNum => $monthName) {
			$menu .= "<option value=\"$monthNum\" ";
						if ($monthNum == date('n')) {
							$menu .= 'selected';
						}
			$menu .= ">$monthName</option>\n";
		}
		$menu .= '</select>';
		
		$menu .= '<select name="years">';
		foreach ($years as $year) {
			$menu .= "<option value=\"$year\">$year</option>\n";
		}
		$menu .= '</select>';
		
		echo $menu;
	}
	
	include 'calendar.html.php';
	
	/***************************************/
	// Open info page for event
	/***************************************/
	
?>

