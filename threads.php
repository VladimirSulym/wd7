<?php
// notify   friends     photos      audio       video   ....
//   0          1
// ?scope=notify,friends 


$crit = '00';

for ($i = 0; $i <= PHP_INT_MAX; $i++) {
    $hash = md5($i);
    if ($hash[0] . $hash[1] == $crit) {
        echo "YES\n";
    }
}

$part = floor(PHP_INT_MAX / 3);
$range = [
    ['start' => 0, 'end' => $part],
    ['start' => $part + 1, 'end' => $part*2],
    ['start' => $part*2 + 1, 'end' => PHP_INT_MAX],
];
for ($c = 0; $c < 3; $c++) {
    $pid = pcntl_fork();

    if (!$pid) {
        for($i = $range[$c]['start']; $i <= $range[$c]['end']; $i++) {
            $hash = md5($i);
            if ($hash[0] . $hash[1] == $crit) {
                echo "YES\n";
            }
        }
    }
}

/*
echo "START";
sleep(5);               // pc 1

$pid = pcntl_fork();    // pc 2

if ($pid) {             // pc 3
    echo $pid . " PARENT \n";
} else {
    echo " CHILD\n";
}

for (;;) {
    sleep(2);
}
/**/