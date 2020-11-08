<?php

namespace App;

class LuckyTicket
{
    private $first;
    private $end;

    private static $cache = [];

    public function __construct($first = 1, $end = 999999)
    {
        $this->first = $first ?? 1;
        $this->end = $end ?? 999999;
    }

    private function validate()
    {
        if ($this->first > $this->end) {
            throw new \RuntimeException('First must been less then end');
        }
    }


    public function calculate(): int
    {
        $this->validate();

        $i = $this->first;
        $count = 0;
        while ($this->end >= $i) {
            $left = $this->sum((int)($i / 1000));
            $right = $this->sum($i % 1000);
            if ($left === $right) {
                $count++;
            }
            $i++;
        }

        return $count;
    }

    public function sum($num)
    {
        if (isset(self::$cache[$num])) {
            return self::$cache[$num];
        }
        $sum = array_sum(str_split((string)$num));
        if ($sum >= 10) {
            $sum = array_sum(str_split((string)$sum));
        }
        self::$cache[$num] = $sum;

        return $sum;
    }
}
