<?php
	require_once('database.php');
  	session_start();
  
  	// エラーメッセージ
  	$errorMessage = "";

  	// ログインボタンが押された場合      
  	if (isset($_POST["login"])) {
		$access = new DBclass;
  		$sql = "SELECT password from user WHERE name = '%s'";
  		$sql = sprintf($sql, mysql_real_escape_string($_POST["userid"]));
  		$password = $access->selectMysql($sql);

    	// 認証成功
    	if (hash('sha256', $_POST["password"]) == $password[0]) {
      		// セッションIDを新規に発行する
      		session_regenerate_id(TRUE);
      		$_SESSION["USERID"] = $_POST["userid"];
      		header("Location: top.php");
      		exit;
    	} else {
      		$errorMessage = "ユーザIDあるいはパスワードに誤りがあります。";
    	}
  	}
  	
  	// 登録ボタンが押された場合      
  	if (isset($_POST["register"])) {
  		$access = new DBclass;
  		$sql = "INSERT INTO user (name, password) VALUES ('%s', '%s')";
  		$sql = sprintf($sql, mysql_real_escape_string($_POST["userid"]), hash('sha256', $_POST["password"]));
  		$result = $access->insertMysql($sql);
  	
  		if ($result) {
  			// セッションIDを新規に発行する
      		session_regenerate_id(TRUE);
      		$_SESSION["USERID"] = $_POST["userid"];
      		header("Location: top.php");
      		exit;
      	} else {
      		$errorMessage = "ユーザIDが無効です。";
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
  <legend>ログインフォーム</legend>
  <div><?php echo $errorMessage ?></div>
  <table>
  <tr>
  <td><label for="userid">ユーザID</label></td>
  <td><input type="text" id="userid" name="userid" value="" maxlength="10" size="10"></td>
  </tr>
  <tr>
  <td><label for="password">パスワード</label></td>
  <td><input type="password" id="password" name="password" value="" maxlength="20"></td>
  </tr>
  </table>
  <span style="margin-left:80px"><label></label><input type="submit" id="login" name="login" value="ログイン"></span>
  <span style="margin-left:40px"><input type="submit" id="login" name="register" value="登録"></span>
  </fieldset>
  </form>
  </body>
</html>