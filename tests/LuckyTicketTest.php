<?php

namespace App\Test;

use App\LuckyTicket;

class LuckyTicketTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @dataProvider numbers
     * @testdox test that `sum` method returns `$equal` with `$num` value.
     */
    public function testSum($num, $equal)
    {
        $lucky = new LuckyTicket();

        self::assertSame($lucky->sum($num), $equal);
    }

    /**
     * @dataProvider numbers
     * @testdox test that `sum` method returns `$equal` with `$num` value.
     */
    public function testSumWithModNine($num, $equal)
    {
        $lucky = new LuckyTicket();

        self::assertSame($lucky->sumWithModNine($num), $equal);
    }

    public function numbers()
    {
        yield [1, 1];
        yield [12, 3];
        yield [16, 7];
        yield [23, 5];
        yield [19, 1];
        yield [123, 6];
        yield [193, 4];
        yield [888, 6];
        yield [199, 1];
        yield [991, 1];
        yield [919, 1];
        yield [901, 1];
        yield [910, 1];
        yield [227, 2];
        yield [117, 9];
        yield [999, 9];
    }

    public function testIncorrectValue()
    {
        $this->expectException(\RuntimeException::class);
        $lucky = new LuckyTicket(2, 1);
        $lucky->calculate();
    }

    /**
     * @dataProvider ranges
     */
    public function testCalculate($first, $end, $result)
    {
        $lucky = new LuckyTicket($first, $end);
        self::assertSame((int)$lucky->calculate(), $result);
    }

    public function ranges()
    {
        yield [1, 999999, 110889];
        yield [1, 2, 0];
        yield [1, 1001, 1];
        yield [1, 1010, 2];
        yield [1, 1100, 12];
    }
}
