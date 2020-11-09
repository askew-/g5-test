<?php

namespace App;

use RuntimeException;

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

    private function validate(): void
    {
        if ($this->first > $this->end) {
            throw new RuntimeException('First must been less then end');
        }
    }


    public function calculate(): int
    {
        $this->validate();

        $i = $this->first;
        $count = 0;
        while ($this->end >= $i) {
            $left = $this->sumWithModNine((int)($i / 1000));
            $right = $this->sumWithModNine($i % 1000);
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
            $sum = $this->sum($sum);
        }
        self::$cache[$num] = $sum;

        return $sum;
    }

    public function sumWithModNine($num): int
    {
        $sum = $num % 9;
        if ($sum === 0 && $num >= 9) {
            $sum = 9;
        }

        return $sum;
    }
}
