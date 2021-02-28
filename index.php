<!DOCTYPE html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Undertaking form by Abdulbaki Suraj</title>
	<style type="text/css">
		input{
			width: 60%;
		}
		#CandName, #MatNumber{
			text-transform: uppercase;
		}
		*{
			font-family: helvetica, arial, serif;
		}
	</style>
</head>
<body>
	
	<!-- display first form to get details from users -->
	<?php if(!isset($_POST['submit_details'])):?>
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
			<h2>COVID19 UNDERTAKING FORM FOR FEDERAL UNIVERSITY OF TECHNOLOGY, MINNA</h2>
		
			<h3>Please fill the form below correctly</h3>
			<label>
				First Name<br/>
				<input type="text" name="first_name" required="required">
			</label><br/><br/>
			<label>
				Middle Name<br/>
				<input type="text" name="middle_name" required="required">
			</label><br/><br/>
			<label>
				Last Name / Surname (Leave empty if you don't have)<br/>
				<input type="text" name="last_name" required="required">
			</label><br/><br/>
			<label>
				Level<br/>
				<input type="number" name="level" required="required">
			</label><br/><br/>
			<label>
				Matriculation Number<br/>
				<input type="text" name="matriculation_number" required="required">
			</label><br/><br/>
			<label>
				Department<br/>
				<input type="text" name="department" required="required">
			</label><br/><br/>
			<p>
				<strong>DISCLAIMER:</strong><br/>
				This is an independent platform created by a fellow student.<br/>
				It is meant as an assistive tool for students who do not have access to their school portal.<br/>
				We do not claim any responsibility for any problem that might arise from the use of this platform.<br/>
				Use at your own risk !!!<br/>
			</p>
			<button type="submit" name="submit_details">Click here to continue >></button>
			<br/><br/>
			<p>
				You can reach out to me via <a target="_blank" href="mailto:surajabdulbaki19@gmail.com">email</a>
			</p>
		</form>
	<?php endif; ?>

	<!-- Second form with details from first form -->
	<?php if(isset($_POST['submit_details'])):

		// variables and functions to process form information
		function sanitizeInput($data)
		{
			$data = trim($data);
			$data = htmlentities($data);
			return $data;
		}
		function formatDepartment($data)
		{
			$result = array();
			$data = strtolower($data);
			$data = ucwords($data);
			$data = explode(" ", $data);
			for($i=0; $i<count($data); $i++):
				if(strtolower($data[$i]) === 'and'):
					array_push($result, strtolower($data[$i]));
				else:
					array_push($result, $data[$i]);
				endif;
			endfor;
			$data = implode(" ", $result);
			return $data;
		}
		$first_name = sanitizeInput($_POST['first_name']);
		$middle_name = sanitizeInput($_POST['middle_name']);
		$last_name = sanitizeInput($_POST['last_name']);
		$mat_number = strtoupper(sanitizeInput($_POST['matriculation_number']));
		$level = sanitizeInput($_POST['level']);
		$department = sanitizeInput($_POST['department']);
		$department = formatDepartment($department);
		$full_name = strtoupper($last_name.' '.$first_name.' '.$middle_name);
		?>
		
		<form action="https://eportal.futminna.edu.ng/accpt/covid19.php" method="POST">
			<h2>COVID19 UNDERTAKING FORM FOR FEDERAL UNIVERSITY OF TECHNOLOGY, MINNA</h2>
			<h3>Please confirm your details below:</h3>
			<input type="hidden" name="CandName" id="CandName" value="<?= $full_name ?>">
			<input type="hidden" type="number" name="level" id="level" value="<?= $level ?>">
			<input type="hidden" name="MatNumber" id="MatNumber" value="<?= $mat_number ?>">
			<input type="hidden" name="deptname" id="deptname" value="<?= $department ?>">
			<table>
				<tr>
					<td><strong>Name:</strong></td>
					<td><?= $full_name; ?></td>
				</tr>
				<tr>
					<td><strong>Department:</strong></td>
					<td><?= $department ?></td>
				</tr>
				<tr>
					<td><strong>Level:</strong></td>
					<td><?= $level ?></td>
				</tr>
				<tr>
					<td><strong>Matriculation number:</strong></td>
					<td><?= $mat_number ?></td>
				</tr>
				<tr>
					<td></td>
					<td><button type="submit">Download Form</button></td>
				</tr>
			</table>
			
		</form>
		<!--
		You can reach out to me via twitter <a target="_blank" href="https://twitter.com/fliplikesuraj">@fliplikesuraj</a>
		-->
	<?php endif; ?>
</body>
</html>