<?php
require_once(dirname(__FILE__) . '/../../../lib/database.php');
include(dirname(__FILE__) . '/../common/chkLogin.php');

$sql = "SELECT name, good from image WHERE good > 0 ORDER BY good DESC";

$access = new DBclass;
$result_array = $access->selectMysqlMulti($sql);

include(dirname(__FILE__) . '/../view/header.html');

foreach($result_array as $rank_data) {
    echo '<h2>' . $rank_data[good] . "•[</h2>\n";
    echo '<img src="../images/' . $rank_data[name] . '" style="width:300;">' .  "<br>\n";
}

echo "</body>\n</html>";
