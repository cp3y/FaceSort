<?php
	require_once('database.php');
  	session_start();
  
  	// �G���[���b�Z�[�W
  	$errorMessage = "";

  	// ���O�C���{�^���������ꂽ�ꍇ      
  	if (isset($_POST["login"])) {
		$access = new DBclass;
  		$sql = "SELECT password from user WHERE name = '%s'";
  		$sql = sprintf($sql, mysql_real_escape_string($_POST["userid"]));
  		$password = $access->selectMysql($sql);

    	// �F�ؐ���
    	if (hash('sha256', $_POST["password"]) == $password[0]) {
      		// �Z�b�V����ID��V�K�ɔ��s����
      		session_regenerate_id(TRUE);
      		$_SESSION["USERID"] = $_POST["userid"];
      		header("Location: top.php");
      		exit;
    	} else {
      		$errorMessage = "���[�UID���邢�̓p�X���[�h�Ɍ�肪����܂��B";
    	}
  	}
  	
  	// �o�^�{�^���������ꂽ�ꍇ      
  	if (isset($_POST["register"])) {
  		$access = new DBclass;
  		$sql = "INSERT INTO user (name, password) VALUES ('%s', '%s')";
  		$sql = sprintf($sql, mysql_real_escape_string($_POST["userid"]), hash('sha256', $_POST["password"]));
  		$result = $access->insertMysql($sql);
  	
  		if ($result) {
  			// �Z�b�V����ID��V�K�ɔ��s����
      		session_regenerate_id(TRUE);
      		$_SESSION["USERID"] = $_POST["userid"];
      		header("Location: top.php");
      		exit;
      	} else {
      		$errorMessage = "���[�UID�������ł��B";
      	}
  	}

?>
<!doctype html>
<html lang="ja">
  <head>
    <title>login</title>
  </head>
  <body>
  <form id="loginForm" name="loginForm" action="<?php print($_SERVER['PHP_SELF']) ?>" method="POST">
  <fieldset>
  <legend>���O�C���t�H�[��</legend>
  <div><?php echo $errorMessage ?></div>
  <table>
  <tr>
  <td><label for="userid">���[�UID</label></td>
  <td><input type="text" id="userid" name="userid" value="" maxlength="10" size="10"></td>
  </tr>
  <tr>
  <td><label for="password">�p�X���[�h</label></td>
  <td><input type="password" id="password" name="password" value="" maxlength="20"></td>
  </tr>
  </table>
  <span style="margin-left:80px"><label></label><input type="submit" id="login" name="login" value="���O�C��"></span>
  <span style="margin-left:40px"><input type="submit" id="login" name="register" value="�o�^"></span>
  </fieldset>
  </form>
  </body>
</html>