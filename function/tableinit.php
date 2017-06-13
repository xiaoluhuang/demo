<?php
require_once __DIR__ . '/../mysql/DB.php';
// insert into sales values(null,11, 12, 334, '2017-01-03');

$days = [
    '2017-01-01', '2017-01-02', '2017-01-03', '2017-01-04', '2017-01-05', '2017-01-06', '2017-01-07',
];

$cnt = 5000000;
$db = new DB('weather');
while ($cnt--) {
    $saler_id = rand(1, 100);
    $money = rand(1, 10000 );
    shuffle($days);

    $sql = sprintf("insert into record values(null, %d, %d, '%s')",
        $money, $saler_id, $days[0]
    );
    echo $sql, PHP_EOL;
    $db->query($sql);
}


