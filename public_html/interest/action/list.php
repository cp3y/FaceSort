<?php
require_once(dirname(__FILE__) . '/../../../lib/database.php');
include(dirname(__FILE__) . '/../common/chkLogin.php');

$sql = "SELECT name, count from user ORDER BY count DESC";

$access = new DBclass;
// ���[�U���Ɖ񓚐���S���擾
$result_array = $access->selectMysqlMulti($sql);


include(dirname(__FILE__) . '/../view/header.html');

echo '<ul type="none" style="text-align:center">' . "\n" . '  <table align="center">' . "\n";
foreach($result_array as $list_data) {
    echo '    <tr><td><a href="result.php?name=' . $list_data[name] . '">' . $list_data[name] . '(' . $list_data[count] . ')</a>' . "</td></tr>\n";
}

echo "  </table>\n</body>\n</html>";
