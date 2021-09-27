<?php


class MultiDim
{
    // private $idx = ['primary' => 'a'];

    private $data = [
        0 => ['name' => 'Pitolet', 'surname' => 'Raphaëlle'],
        1 => ['name' => 'Boilley', 'surname' => 'Adrien'],
    ];

    function __construct()
    {
    }


    function test()
    {
        $this->map(
            function () {
            }
        );
    }

    function map($callable)
    {
        foreach ($this->data as $nrow => $row)
            $callable($row, $nrow);
    }
}
