<?php
require_once __DIR__ . '/../mysql/DB.php';
// insert into sales values(null,11, 12, 334, '2017-01-03');
$userIds = [
    11, 12, 13, 15, 20
];

$days = [
    '2017-01-01', '2017-01-02', '2017-01-03', '2017-01-04', '2017-01-05', '2017-01-06', '2017-01-07',
];

$cnt = 3;
$db = new DB();
while ($cnt--) {
    shuffle($userIds);
    shuffle($days);

    $sql = sprintf("insert into sales values(null, %d, %d, %d, '%s')",
        $userIds[0], rand(1, 1000000), rand(1000, 100000000), $days[0]
    );
    echo $sql, PHP_EOL;
    $db->query($sql);
}


