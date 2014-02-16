<?php
require_once(dirname(__FILE__) . '/../../../lib/database.php');
include(dirname(__FILE__) . '/../common/chkLogin.php');

$sql = 'SELECT COUNT(no) FROM image';
$sql2 = 'SELECT name FROM image WHERE no = %d';
$sql3 = "SELECT good, bad FROM user WHERE name = '%s'";

$access = new DBclass;

// 画像全件数取得
$total_img = $access->selectMysql($sql);

// バインド変数
$sql3 = sprintf($sql3, mysql_real_escape_string($_SESSION["USERID"]));
$result_array = $access->selectMysql($sql3);
if ($result_array[0] != ':') {
	$good_array = explode(',', ltrim($result_array[0], ':,'));
}
if ($result_array[1] != ':') {
	$bad_array = explode(',', ltrim($result_array[1], ':,'));
}

// まだ選択されていない画像が残っているとき
if ($total_img[0] > count($good_array) + count($bad_array)) {
    $goot_result = false;
    $bad_result = false;
    do {
        // 乱数で表示する画像を選択
        $disp_no = mt_rand(1, $total_img[0]);
        // 回答済みかどうかをチェック
        if ($good_array != null) {
            if (in_array($disp_no, $good_array)) {
                $goot_result = true;
            } else {
                $goot_result = false;
            }
        }
        if ($bad_array != null) {
            if (in_array($disp_no, $bad_array)) {
                $bad_result = true;
            } else {
                $bad_result = false;
            }
        }
    } while ($goot_result == true || $bad_result == true);

    // バインド
    $sql2 = sprintf($sql2, $disp_no);
    $result = $access->selectMysql($sql2);
    // 画像のパスを生成
    $image_path = '../images/' . $result[0];
    // 表示した画像の番号を保存
    $_SESSION[NO] = $disp_no;
}


include(dirname(__FILE__) . '/../view/header.html');

if ($total_img[0] > count($good_array) + count($bad_array)) {
    echo <<< EOF
<br>
<div style="text-align:center;">
  <form method="POST" action="answer.php">
    <input type="submit" name="good" value="付き合いたい" style="background-color: blue; color: white;" >
    <input type="submit" name="bad" value="んーー・・・" >
  </form>
  <img src="$image_path" style="width:600;"/>
</div>
</body>
</html>

EOF;
} else {
    echo "END</body>\n</html>";
}