<?php


namespace App;


class Tax
{

    /* @var int */
    private $income;

    /* @var int */
    private $familial_quotient;

    public function __construct(int $income, int $familial_quotient)
    {
        $this->income = $income;
        $this->familial_quotient = $familial_quotient;
    }

    public function incomeByFamilialQuotient() {
        return $this->income/$this->familial_quotient;
    }

    public function scaleCalculation($tax, $income_fam_quotient, $scale) {

        if($income_fam_quotient < $scale){
            $res = $income_fam_quotient;
            $income_fam_quotient = 0;
        } else {
            $res = $scale;
            $income_fam_quotient -= $scale;
        };

        return [$scales_res, $income_fam_quotient];
    }

    public function sliceImposition(){
        /* TODO verify case when  income === one of the scale */
        $income_fam_quotient = $this->incomeByFamilialQuotient();
//        $scales = [10084, 25710, 73516, 158122];
        //[$tax, $income_fam_quotient] = $this->scaleCalculation($tax, $income_fam_quotient, $scale);

        $income_fam_quotient = $this->income/$this->familial_quotient;
        $scales = [10085, 15626, 37722, 48812];
        $rate = [0.11, 0.30, 0.41, 0.45];
        $tax = 0;
        foreach ($scales as $index => $scale){
            if($income_fam_quotient <= 0)
                return;
            if($income_fam_quotient < $scale){
                $res = $income_fam_quotient;
                $income_fam_quotient = 0;
            } else {
                $res = $scale;
                $income_fam_quotient -= $scale;
            };
            $tax += $res * $rate[$index];
        }

var_dump($tax);
        /*$tax = 0;
        array_shift($scales_res);
        foreach ($scales_res as $index => $scale_res){
            switch ($index){
                case 0:
                    $tax += $scale_res * 0.11;
                    break;
                case 1:
                    $tax += $scale_res * 0.30;
                    break;
                case 2:
                    $tax += $scale_res * 0.41;
                    break;
                case 3:
                    $tax += $scale_res * 0.45;
                    break;
            }
        }*/

        var_dump($tax);
/*        array_push($scale, $income_fam_quotient);
        sort($scale);
        $index = array_search($income_fam_quotient, $scale);*/

        }
/*
        switch (true) {
            case $income_fam_quotient < 10084:
                break;
            case $income_fam_quotient < 25710:
                break;
            case $income_fam_quotient < 73516:
                break;

        }*/

}