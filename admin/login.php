<?php
class Login
{
	private $usr;
	private $email;
	private $pwd;
	
	function __construct()
	{
		require '../config.php';
		$this->usr = $_POST['usr'];
		$this->email = $_POST['email'];
		$this->pwd = $_POST['pwd'];
	}
	
	public function checkEmailFormat()
	{
		$pattern = "/^([0-9A-Za-z\\-_\\.]+)@([0-9a-z]+\\.[a-z]{2,3}(\\.[a-z]{2})?)$/i";
		if (!preg_match($pattern, $this->email))
		{
			echo "<script>alert('邮箱格式不正确!');</script>";
			exit();
		}
	}
	
	public function checkNameFormat()
    {
        $length = strlen($this->usr);
        if (trim($this->usr) == '' || $length < 2 || $length > 20) {
            echo "<script>alert('用户名不符合规则!');</script>";
            exit();
        }
    }
	public function checkUsr()
	{
		$db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常!');
		$sql = "SELECT id FROM as_account WHERE id = '".$this->usr."' and pass = '".md5($this->pwd)."'";
		$result = (mysqli_fetch_row($db->query($sql)));
		if (!$result[0])
		{
			echo "登录失败！";
			exit();
		}
		else
		{
			$_SESSION['usr'] = $result[0];
			echo "登录成功！<br>session=".$result[0];
			$db->close();
			exit();
		}
	}
	
	public function doLogin()
	{
		//$this->checkEmailFormat();
		$this->checkNameFormat();
		$this->checkUsr();
	}
}

	$log = new Login();
	$log->doLogin();
?>