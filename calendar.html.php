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
					<div class="select-month">
						<?php echo changeCalendar(); ?>
						<input type="submit" class="button" value="Go">
					</div>
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