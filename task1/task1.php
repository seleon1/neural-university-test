<?php

class Test
{
    public $next;
    public $x;

    public function __construct(int $x)
    {
        $this->x = $x;
    }
}

function reverse(Test $head): Test
{
    $curr = $head;
    $prev = null;
    while ($curr != null) {
        $next = $curr->next;
        $curr->next = $prev;

        $prev = $curr;
        $curr = $next;
    }
    return $prev;
}

$a = new Test(1);
$b = new Test(2);
$c = new Test(3);
$a->next = $b;
$b->next = $c;
$c->next = null;

echo 'Исходный объект:' . PHP_EOL;
var_dump($a);
echo 'Перевернутый объект:' . PHP_EOL;
var_dump(reverse($a));
