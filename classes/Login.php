<?php
require_once '../config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class Login extends DBConnection
{
	private $settings;
	public function __construct()
	{
		global $_settings;
		$this->settings = $_settings;

		parent::__construct();
		ini_set('display_error', 1);
	}
	public function __destruct()
	{
		parent::__destruct();
	}
	public function index()
	{
		echo "<h1>Access Denied</h1> <a href='" . base_url . "'>Go Back.</a>";
	}
	public function login()
	{
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT * from users where username = ? and password = ? ");
		$pw = md5($password);
		$stmt->bind_param('ss', $username, $pw);
		$stmt->execute();
		$qry = $stmt->get_result();
		if ($qry->num_rows > 0) {
			$res = $qry->fetch_array();
			if ($res['status'] != 1) {
				return json_encode(array('status' => 'notverified'));
			}
			foreach ($res as $k => $v) {
				if (!is_numeric($k) && $k != 'password') {
					$this->settings->set_userdata($k, $v);
				}
			}
			$this->settings->set_userdata('login_type', $res['type']);
			$this->settings->set_userdata('user_id', $res['id']);
			return json_encode(array('status' => 'success', 'login_type' => $res['type']));
		} else {
			return json_encode(array('status' => 'incorrect', 'error' => $this->conn->error));
		}
	}
	public function logout()
	{
		if ($this->settings->sess_des()) {
			redirect('index.php');
		}
	}
	function employee_login()
	{
		extract($_POST);
		$stmt = $this->conn->prepare("SELECT *,concat(lastname,', ',firstname,' ',middlename) as fullname from employee_list where email = ? and `password` = ? ");
		$pw = md5($password);
		$stmt->bind_param('ss', $email, $pw);
		$stmt->execute();
		$qry = $stmt->get_result();
		if ($this->conn->error) {
			$resp['status'] = 'failed';
			$resp['msg'] = "An error occurred while fetching data. Error:" . $this->conn->error;
		} else {
			if ($qry->num_rows > 0) {
				$res = $qry->fetch_array();
				if ($res['status'] == 1) {
					foreach ($res as $k => $v) {
						$this->settings->set_userdata($k, $v);
					}
					$this->settings->set_userdata('login_type', 2);
					$resp['status'] = 'success';
				} else {
					$resp['status'] = 'failed';
					$resp['msg'] = "Your Account is Inactive. Please Contact the Management to verify your account.";
				}
			} else {
				$resp['status'] = 'failed';
				$resp['msg'] = "Invalid email or password.";
			}
		}
		return json_encode($resp);
	}
	public function employee_logout()
	{
		if ($this->settings->sess_des()) {
			redirect('./login.php');
		}
	}


	public function forgot_password()
	{



		require '../plugins/PHPMailer/src/Exception.php';
		require '../plugins/PHPMailer/src/PHPMailer.php';
		require '../plugins/PHPMailer/src/SMTP.php';


		$email = $_POST['email'];
		$newpassword = base64_encode(random_bytes(10));
		// $data = [
		// 	'password' => $newpassword,

		// ];
		$newpassword2 = md5($newpassword);

		$sql = "UPDATE users SET password = '$newpassword2' WHERE email = '{$email}' ";
		$save = $this->conn->query($sql);
		$accpass = '~Ew25ff%}d]m';
		if ($save) {
			$mail = new PHPMailer(true);

			try {

				//Server settings
				$mail->SMTPDebug = 0;                      //Enable verbose debug output
				$mail->isSMTP();                                            //Send using SMTP
				$mail->Host = 'sppd.e-veterinar.com';                     //Set the SMTP server to send through
				$mail->SMTPAuth = true;                                   //Enable SMTP authentication
				$mail->Username = 'acc@sppd.e-veterinar.com';                     //SMTP username
				$mail->Password = $accpass;                               //SMTP password
				$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
				$mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

				//Recipients
				$mail->setFrom('acc@sppd.e-veterinar.com', 'Account Manager');
				$mail->addAddress($email, 'User');     //Add a recipient
				// $mail->addAddress('ellen@example.com');               //Name is optional
				// $mail->addReplyTo('info@example.com', 'Information');
				// $mail->addCC('cc@example.com');
				// $mail->addBCC('bcc@example.com');

				//Attachments
				// $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
				// $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

				//Content
				$mail->isHTML(true);                                  //Set email format to HTML
				$mail->Subject = 'Your Reset Password Is Here';
				$mail->Body = 'No worries about your password , we all forget it sometimes. <br>Your password is : <br><br>' . $newpassword;
				$mail->AltBody = 'No worries about your password , we all forget it sometimes';

				$mail->send();
				$resp['status'] = 'success';
				$resp['msg'] = 'success';
			} catch (Exception $e) {
				$resp['status'] = 'fail';
				$resp['msg'] = "{$mail->ErrorInfo}";

				// echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
			}
		}

		return json_encode($resp);


	}
}
$action = !isset($_GET['f']) ? 'none' : strtolower($_GET['f']);
$auth = new Login();
switch ($action) {
	case 'login':
		echo $auth->login();
		break;
	case 'logout':
		echo $auth->logout();
		break;
	case 'elogin':
		echo $auth->employee_login();
		break;
	case 'elogout':
		echo $auth->employee_logout();
		break;

	case 'forgot_password':
		echo $auth->forgot_password();
		break;
	default:
		echo $auth->index();
		break;
}

