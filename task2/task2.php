<?php

function calculateCourierDepartures($boxes, $n) {
    $boxesCounts = [];
    foreach ($boxes as $box) {
        $boxesCounts[$box] = isset($numberCounts[$box]) ? $numberCounts[$box] + 1 : 1;
    }

    $departuresCount = 0;

    foreach ($boxes as $box) {
        $boxesCounts[$box]--;
        $complement = $n - $box;

        if (isset($boxesCounts[$complement]) && $boxesCounts[$complement] > 0) {
            $departuresCount++;
            $boxesCounts[$complement]--;
        }
    }

    return $departuresCount;
}
$boxes = [1, 2, 1, 5, 1, 3, 5, 2, 5, 5, 3];
$boxes2 = [2, 4, 3, 6, 1];
$n = 6;
$n2 = 5;

echo 'Максимальное кол-во выездов курьера с минимальным кол-вом невостребованных коробок: ' . calculateCourierDepartures($boxes, $n) . PHP_EOL;
echo 'Максимальное кол-во выездов курьера с минимальным кол-вом невостребованных коробок: ' . calculateCourierDepartures($boxes2, $n2) . PHP_EOL;
