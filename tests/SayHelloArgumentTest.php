<?php


use PHPUnit\Framework\TestCase;

class SayHelloArgumentTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($input, $expected)
    {
        $this->assertEquals($expected, sayHelloArgument($input));
    }

    public function positiveDataProvider()
    {
        return [
            ['test', 'Hello test'],
            [1, 'Hello 1'],
            [true, 'Hello 1'],
            [false, 'Hello '],
            [null, 'Hello '],
            [0, 'Hello 0']
        ];
    }
}
