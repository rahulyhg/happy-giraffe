<?php

class CounterWidget extends CWidget
{
    const DIGITS_PER_SECTION = 3;

    /**
     * прибивление поситителей по часам
     * @var array
     */
    private $visits = array(
        0 => 3000,
        1 => 2000,
        2 => 1000,
        3 => 1000,
        4 => 1000,
        5 => 1000,
        6 => 2000,
        7 => 3000,
        8 => 5000,
        9 => 6000,
        10 => 7000,
        11 => 8000,
        12 => 10000,
        13 => 10000,
        14 => 10000,
        15 => 10000,
        16 => 10000,
        17 => 10000,
        18 => 10000,
        19 => 10000,
        20 => 10000,
        21 => 10000,
        22 => 8000,
        23 => 5000,
    );

    public function run()
    {
        $visitors = UserAttributes::get(1, 'all_visitors_count', 20753982);
        $hour = (int)date("H");
        $minute = (int)date("i");
        $second = (int)date("s");
        $visitors += round(($this->visits[$hour] * $minute) / 60 + ($this->visits[$hour] * $second) / 3600);
        $this->render('CounterWidget', compact('visitors'));
    }
}
