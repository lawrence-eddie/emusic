<?php
define('ERROR_LOG', '../logs/errors.log');

// Connect to the database .
require_once('../obaEddie_connect.php');

require_once '../HTMLPurifier/HTMLPurifier.auto.php';
$config = HTMLPurifier_Config::createDefault();
$purifier = new HTMLPurifier($config);

if (!empty($_POST['user_login']) && !empty($_POST['password_login'])) {

	$errors = []; // Initialize error array.

	// Validate the username/email address:
	$user_login = $purifier->purify(filter_var($_POST['user_login']));
	if ((!empty($user_login)) && (preg_match('/[a-z0-9\-\s\']/i', $user_login) or filter_var($user_login, FILTER_VALIDATE_EMAIL))) {
		//Sanitize the trimmed user_login
		$user_login = $user_login;
	} else {
		$errors[] = 'Username or email missing.';
	}

	// Validate the password:
	$password_login = $purifier->purify(filter_var($_POST['password_login']));
	if (empty($password_login)) {
		$errors[] = 'Please enter a valid password';
	} else {
		if (!preg_match(
			'/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d#$@!%&*?]{8,}$/',
			$password_login
		)) {
			$errors[] = 'Invalid password, 8 or more characters. At least one upper, one lower and one number.';
		}
	}

	if (isset($_POST['rememberme'])) {
		$rememberme = $_POST['rememberme'];
	}

	if (empty($errors)) {
		try {
			$query = "SELECT * FROM users WHERE (user_name=? OR email=?) AND blocked_user='0' AND (activated IS NULL OR activated = '')";

			$q = mysqli_stmt_init($dbcon);
			mysqli_stmt_prepare($q, $query);

			// bind $id to SQL Statement
			mysqli_stmt_bind_param($q, "ss", $user_login, $user_login);
			// execute query
			mysqli_stmt_execute($q);
			$result = mysqli_stmt_get_result($q);

			// Check the result:
			if (mysqli_num_rows($result) == 1) {
				// fetch the records
				$data = mysqli_fetch_assoc($result);
				mysqli_free_result($result);
				// Check for password verification
				if (password_verify($password_login, $data['password'])) {
					//Return true and the record:
					// return [true, $row];
					// Access the session details
					$_SESSION['user_id'] = $data['user_id'];
					$_SESSION['first_name'] = $data['first_name'];
					$_SESSION['user_name'] = $data['user_name'];
					$_SESSION['user_level'] = $data['user_level'];
					// Store the HTTP_USER_AGENT:
					$_SESSION['browser'] = sha1($_SERVER['HTTP_USER_AGENT']);
					// I need to set a cookie for the users picture here so i could display it next to the login form
					setcookie('user_name', $data['user_name'], time() + (365 * 24 * 60 * 60), "/", "", 0, 0);

					if ($rememberme != NULL) {
						setcookie('user_id', $data['user_id'], time() + (365 * 24 * 60 * 60), "/", "", 0, 0);
					}
					if ($_SESSION['user_level'] == 71) {
						// header('../../admin/index.php');
						echo "admin";
					} else {
						// redirect_user();
						echo "success";
					}
				} else {  //No password match was made.
					$errors[] = 'Username/Email or Password entered does not match our records. ';
					$errors[] = 'Perhaps you need to <a href="../login_register.php?signUp=#signUp">Sign up</a> for an account.';
					$implodeError = implode(' ', $errors);
					echo $implodeError;
					return false;
				}
			} else { // Check to see if the account is not yet activated
				$query1 = "SELECT * FROM users WHERE (user_name=? OR email=?) AND (activated != '' OR activated IS NOT NULL)";

				$q = mysqli_stmt_init($dbcon);
				mysqli_stmt_prepare($q, $query1);

				// bind $id to SQL Statement
				mysqli_stmt_bind_param($q, "ss", $user_login, $user_login);

				// execute query
				mysqli_stmt_execute($q);
				$result = mysqli_stmt_get_result($q);

				// Check the result:
				if (mysqli_num_rows($result) == 1) {
					// fetch the records
					$row = mysqli_fetch_assoc($result);
					mysqli_free_result($result);
					// Check for password verification
					if (password_verify($password_login, $row['password'])) {
						$errors[] = 'Please activate your account.<br>Check your email for activation link. If no email was sent. Contact
						<a href="../contactUs.php">administrator<a/> for further assistance';
						//Return false and the error:
						// return [false, $errors];
						$implodeError = implode(',', $errors);
						echo $implodeError;
						return false;
					} else {  //No password match was made.
						$errors[] = 'Username/Email or Password entered does not match our records. ';
						$errors[] = 'Perhaps you need to <a href="../login_register.php?signUp=#signUp">Sign up</a> for an account.';
						$implodeError = implode(' ', $errors);
						echo $implodeError;
						return false;
					}
				} else { // Check to see if the account is blocked:
					$query2 = "SELECT * FROM users WHERE (user_name=? OR email=?) AND blocked_user = '1' ";

					$q = mysqli_stmt_init($dbcon);
					mysqli_stmt_prepare($q, $query2);

					// bind $id to SQL Statement
					mysqli_stmt_bind_param($q, "ss", $user_login, $user_login);

					// execute query
					mysqli_stmt_execute($q);
					$result = mysqli_stmt_get_result($q);

					// Check the result:
					if (mysqli_num_rows($result) == 1) {
						// fetch the records
						$row = mysqli_fetch_assoc($result);
						mysqli_free_result($result);
						// Check for password verification
						if (password_verify($password_login, $row['password'])) {
							$errors[] = 'This account has been blocked.<br>If you feel there has been a mistake. Please contact
							<a href="../contactUs.php">administrator<a/> for further assistance.';
							//Return false and the error:
							// return [false, $errors];
							$implodeError = implode(',', $errors);
							echo $implodeError;
							return false;
						} else {  //No password match was made.
							$errors[] = 'Username/Email or Password entered does not match our records. ';
							$errors[] = 'Perhaps you need to <a href="../login_register.php?signUp=#signUp">Sign up</a> for an account.';
							$implodeError = implode(' ', $errors);
							echo $implodeError;
							return false;
						}
					} else {
						$errors[] = 'Username/Email or Password entered does not match our records. ';
						$errors[] = 'Perhaps you need to <a href="../login_register.php?signUp=#signUp">Sign up</a> for an account.';
						$implodeError = implode(' ', $errors);
						echo $implodeError;
						return false;
					}
				} // End of checking blocked account
			} // End of checking account activation
		} // End of try and verified workable account
		catch (Exception $e) {
			print "The system is busy, please try later";
			$error_string = date('mdYhis') . " | Login | " . $e->getMessage() . "\n";
			error_log($error_string, 3, "../logs/exception_log.log");
			//error_log("Exception in Login Program. Check log for details", 1, "noone@nowhere.com",
			//	"Subject: Login Exception" . "\r\n");
			// You can turn off display of errors in php.ini display_errors = Off
			//print "An Exception occurred. Message: " . $e->getMessage();
		} catch (Error $e) {
			print "The system is busy, please come back later";
			$error_string = date('mdYhis') . " | Login | " . $e->getMessage() . "\n";
			error_log($error_string, 3, "../logs/errors.log");
			//error_log("Error in Login Program. Check log for details", 1, "noone@nowhere.com",
			//	"Subject: Login Error" . "\r\n");
			// You can turn off display of errors in php.ini display_errors = Off
			//print "An Error occurred. Message: " . $e->getMessage();
		}
	}
	// Retrieve the error messages
	// return array(false, $errors);
	$implodeError = implode(',', $errors);
	echo $implodeError;
	return false;
	// echo $errors;
}
