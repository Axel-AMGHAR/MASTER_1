<?php


namespace App\Tests;

use App\Tax;
use PHPUnit\Framework\TestCase;

class TaxTest extends TestCase
{

    /**
     * @dataProvider getIncomeByFamilialQuotient
     * @param Tax $tax
     * @param int $expected
     */
    public function testIncomeByFamilialQuotient(Tax $tax, int $expected){
        $res = $tax->incomeByFamilialQuotient();
        $this->assertSame($expected, $res);
    }

    /* TODO income can't be negative / same with familial quotient */
    public function getIncomeByFamilialQuotient()
    {
        return [
            [new Tax(32000, 1), 32000],
            [new Tax(55950, 3), 18650],
        ];
    }

    /**
     * @dataProvider getSliceImposition
     * @param Tax $tax
     * @param array $expected
     */
    public function testSliceImposition(Tax $tax, array $expected){
        $res = $tax->sliceImposition();
        $this->assertSame($expected, $res);
    }

    public function getSliceImposition()
    {
        return [
            [new Tax(32000, 1), [0, 1718.75, 1886.7]],
            [new Tax(55950, 3), [0, 942.15]],
        ];
    }



}