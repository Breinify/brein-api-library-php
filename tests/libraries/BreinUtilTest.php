<?php

use Breinify\API\libraries\BreinUtil;

class BreinUtilTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test that the array is filtered correctly.
     */
    public function test_that_filtering_works()
    {
        $result = BreinUtil::filterArray([
            "A" => "a", "a" => "A",
            "B" => "b", "b" => "B",
            "C" => "c", "c" => "C",
            "D" => "d", "d" => "D",
            "E" => "e", "e" => "E",
            "F" => "f", "f" => "F",
            "G" => "g", "g" => "G",
        ], ["A", "B", "C", "D", "E", "F", "G", "H"]);

        $this->assertArrayHasKey("A", $result);
        $this->assertArrayHasKey("B", $result);
        $this->assertArrayHasKey("C", $result);
        $this->assertArrayHasKey("D", $result);
        $this->assertArrayHasKey("E", $result);
        $this->assertArrayHasKey("F", $result);
        $this->assertArrayHasKey("G", $result);
        $this->assertEquals(7, count($result));

        $result = BreinUtil::filterArray([
            "A" => "a", "a" => "A",
            "B" => "b", "b" => "B",
            "C" => "c", "c" => "C",
            "D" => "d", "d" => "D",
            "E" => "e", "e" => "E",
            "F" => "f", "f" => "F",
            "G" => "g", "g" => "G",
        ], []);

        $this->assertEquals(0, count($result));
    }
}
