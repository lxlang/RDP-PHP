<?php

namespace Test;

use davidredgar\polyline\RDP;

class BasicPositiveTest extends \PHPUnit\Framework\TestCase
{
    public function testBasic1(): void
    {
        $line = [
            [150, 10],
            [200, 100],
            [360, 170],
            [500, 280]];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 30);

        $expectedResult = [
            [150, 10],
            [200, 100],
            [500, 280]];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testBasic2(): void
    {
        $line = [
            [-30, -40],
            [-20, -10],
            [10, 10],
            [50, 0],
            [40, -30],
            [10, -40]
        ];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 12);

        $expectedResult = [
            [-30, -40],
            [10, 10],
            [50, 0],
            [40, -30],
            [10, -40]
        ];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 15);

        $expectedResult = array(
            array(-30, -40),
            array(10, 10),
            array(50, 0),
            array(10, -40));

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 20);

        $expectedResult = [
            [-30, -40],
            [10, 10],
            [50, 0],
            [10, -40]
        ];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 45);

        $expectedResult = [
            [-30, -40],
            [10, 10],
            [10, -40]];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testBasic3(): void
    {
        $line = [
            [0.0034, 0.013],
            [0.0048, 0.006],
            [0.0062, 0.01],
            [0.0087, 0.009]
        ];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 0.001);

        $expectedResult = [
            [0.0034, 0.013],
            [0.0048, 0.006],
            [0.0062, 0.01],
            [0.0087, 0.009]];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 0.003);

        $expectedResult = [
            [0.0034, 0.013],
            [0.0048, 0.006],
            [0.0087, 0.009]
        ];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 0.01);

        $expectedResult = [
            [0.0034, 0.013],
            [0.0087, 0.009]];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }
}
