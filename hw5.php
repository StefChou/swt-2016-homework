<?php 

function validate_registration($name, $email, $age, $website, $password1, $password2){
$errors = [];
	// validating the name
	if(!isset($name) || !strlen(trim($name))){
		$errors[] = 'You must set a name';
	}
	// validating the email
	if(!isset($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)){
		$errors[] = 'The email you entered is invalid';
	}
	// validating the age
	if(!isset($age) || $age < 21){
		$errors[] = 'You are too young to register';
	}
	// validating the website
	if(!isset($website) || !filter_var($website, FILTER_VALIDATE_URL)){
		$errors[] = 'The website you entered has an invalid url';
	}
	// validating the password
	if(!isset($password1) || !isset($password2) || strlen(trim($password1)) < 6 || strlen(trim($password2)) < 6 || $password1 !== $password2){
		$errors[] = 'Passwords don\'t match';
	}
	// checking for errors
	if(count($errors) == 0){
		write_data($name, $email, $age, $website, $password1);
		//return true;
	} else {
		echo 'ERRORS!';
		return false;
	}
}


function write_data($name, $email, $age, $website, $password){
	$fh = fopen('formular.txt', 'a+');
	$wstring = $name.'|'.$email.'|'.$age.'|'.$website.'|'.$password.';';
	fwrite($fh, $wstring);
	fclose($fh);
}

function build_table(){
	$fh = fopen('formular.txt', 'a+');
	$table = fread($fh, filesize('formular.txt'));
	fclose($fh);

	$rows = explode(';', $table);
	
	echo '<table width="100%" border="1">';
	echo '
	<tr>
		<th>Name</th>
		<th>Email</th>
		<th>Age</th>
		<th>Website</th>
		<th>Password</th>
	</tr>';

	foreach($rows as $row){
		$row_data = explode('|', $row);
		// print_r($row_data);
		if(count($row_data) != 1){
			echo '
				<tr>
					<td>'.$row_data[0].'</td>
					<td>'.$row_data[1].'</td>
					<td>'.$row_data[2].'</td>
					<td>'.$row_data[3].'</td>
					<td>'.$row_data[4].'</td>
				</tr>
			';
		}
	}
	echo '</table>';
}


validate_registration($_POST['name'], $_POST['email'], $_POST['age'], $_POST['website'], $_POST['password1'], $_POST['password2']);

?>

<html>
	<head>
		<title></title>
	</head>
	<body>
		<?php build_table(); ?>
	</body>
</html>