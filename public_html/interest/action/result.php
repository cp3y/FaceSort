<?php
require_once(dirname(__FILE__) . '/../../../lib/database.php');
include(dirname(__FILE__) . '/../common/chkLogin.php');

$sql = "SELECT good, bad FROM user WHERE name = '%s'";
$sql2 = 'SELECT name FROM image WHERE no = %d';

// list����̑J�ڂ��ǂ����p�����[�^���m�F
if ($_GET["name"]) {
	$name = $_GET["name"];
} else {
	$name = $_SESSION["USERID"];
}

$access = new DBclass;
// �o�C���h
$sql = sprintf($sql, mysql_real_escape_string($name));
$result_array = $access->selectMysql($sql);

if ($result_array[0] != ':') {
	$good_array = explode(',', ltrim($result_array[0], ':,'));
	$good_images = array();
	foreach($good_array as $no) {
		// �o�C���h�ϐ�
		$sql2b = sprintf($sql2, $no);
		$result = $access->selectMysql($sql2b);
		$good_images[] = $result[0];
	}
}
if ($result_array[1] != ':') {
	$bad_array = explode(',', ltrim($result_array[1], ':,'));
	$bad_images = array();
	foreach($bad_array as $no) {
		// �o�C���h�ϐ�
		$sql2b = sprintf($sql2, $no);
		$result = $access->selectMysql($sql2b);
		$bad_images[] = $result[0];
	}
}


include(dirname(__FILE__) . '/../view/header.html');

echo '<h2>�t����������</h2>' . "\n" . '<ul class="boxline">' . "\n";

if($good_images) {
    foreach($good_images as $name) {
        echo '<li><img src="../images/' . $name . '" /></li>' . "\n";
    }
}

echo '</ul>' . "\n" . '<h2>�����ł��Ȃ�</h2>' . "\n" . '<ul class="boxline">' . "\n";

if($bad_images) {
    foreach($bad_images as $name) {
        echo '<li><img src="../images/' . $name . '" /></li>' . "\n";
    }
}

echo <<< EOF
</ul>
</body>
</html>

EOF;
