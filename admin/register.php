<?php
class Register
{
	private $usr;
	private $db;
	private $email;
	private $pwd;
	private $conpwd;
	function __construct()
	{
		require '../config.php';
		$this->db = new mysqli(DB_HOST, DB_USER, DB_PWD, DB_NAME) or die('数据库连接异常');
        $stmt = $this->db->prepare('SELECT id, pass FROM as_account');
        $stmt->execute();
        $stmt->bind_result($id, $pass);
        while ($stmt->fetch()) {
            echo "ID:$id   PASS:$pass";
        }
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
	
	public function checkPwd()
	{
		if ($this->pwd != $this->conpwd)
		{
			echo "<script>alert('两次密码不一致!');</sciprt>";
			exit();
		}
		$this->pwd = md5($this->pwd);
	}
	
	public function doRegister()
	{
		$this->email = $_POST['email'];
		$this->usr = $_POST['usr'];
		$this->pwd = $_POST['pwd'];
		$this->conpwd = $_POST['conpwd'];
		$this->checkEmailFormat();
		$this->checkNameFormat();
		$this->checkPwd();
		$sql = "INSERT INTO as_account VALUES('".$this->usr."', '".$this->pwd."')";
		$result = $this->db->query($sql);
		if ($result)
		{
			$this->db->close();
			echo "<script>alert('注册成功!');</script>";
			exit();
		}
		else
		{
			echo $this->db->error;
			exit();
		}
	}
	
}
	$reg = new Register();
	$reg->doRegister();
?>