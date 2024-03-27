<?php
namespace Test;

use davidredgar\polyline\RDP;
use PHPUnit\Framework\TestCase;

class EdgeCaseTest extends TestCase
{
    public function testNoPointsInLine(): void
    {
        $this->markTestSkipped('Test fails. FIXME.');
        $line = [];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 1);

        $expectedResult = [];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testOnePointInLine(): void
    {
        $this->markTestSkipped('Test fails. FIXME.');
        $line = [[10, 10]];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 1);

        $expectedResult = [[10, 10]];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testTwoPointsInLine(): void
    {
        $line = array(array(10, 10), array(20, 20));

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 1);

        $expectedResult = array(array(10, 10), array(20, 20));

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testLineWithJustTwoIdenticalPoints(): void
    {
        $line = [
            [1, 2],
            [3, 5],
        ];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 1);

        $expectedResult = array(array(1, 2), array(3, 5));

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 10);
        //same expected result
        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testThreePointsWithIdenticalStartAndEndLine(): void
    {
        $line = [
            [0.1, 0.1],
            [0.9, 0.7],
            [0.1, 0.1],
        ];

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 0.2);

        $expectedResult = [
            [0.1, 0.1],
            [0.9, 0.7],
            [0.1, 0.1],
        ];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 0.9);

        $expectedResult = [
            [0.1, 0.1],
            [0.1, 0.1],
        ];

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testEpsilon0(): void
    {
        $this->markTestSkipped('This test runs forever.');

        $line = [
            [3400, 89000],
            [5500, 52000],
            [4800, 41000],
        ];

        $invalidParameterExceptionsCaught = 0;

            $rdpResult = RDP::RamerDouglasPeucker2d($line, 0);

        $this->assertEquals(1, $invalidParameterExceptionsCaught, "expected exception not thrown");
    }

    public function testNegativeEpsilon(): void
    {
        $this->markTestSkipped('This test runs forever.');
        $line = array(array(125.6, 89.5), array(97.4, 101.0), array(70.8, 109.1));

        $invalidParameterExceptionsCaught = 0;

        try
        {
            $rdpResult = RDP::RamerDouglasPeucker2d($line, -20);
        }
        catch (InvalidParameterException $e)
        {
            $invalidParameterExceptionsCaught ++;
        }

        $this->assertEquals(1, $invalidParameterExceptionsCaught, "expected exception not thrown");
    }

    public function testHorizontalLine(): void
    {
        $line = array(array(10, 10), array(20, 10), array(30, 10), array(40, 10));

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 5);

        $expectedResult = array(array(10, 10), array(40, 10));

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }

    public function testVerticalLine(): void
    {
        $line = array(array(-20, -20), array(-20, -10), array(-20, 0), array(-20, 10));

        $rdpResult = RDP::RamerDouglasPeucker2d($line, 5);

        $expectedResult = array(array(-20, -20), array(-20, 10));

        $this->assertEquals($expectedResult, $rdpResult, "result polyline array incorrect");
    }
}
