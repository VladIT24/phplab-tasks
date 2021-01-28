<?php


use PHPUnit\Framework\TestCase;

class CountArgumentsTest extends TestCase
{

    public function testPositive()
    {
        $expected = [
            'argument_count' => 0,
            'argument_values' => []
            ];

        $this->assertEquals($expected, countArguments());
    }

    /**
     * @dataProvider positiveDataProviderOneArg
     */

    public function testPositiveOneArg($input, $expected)
    {
        $this->assertEquals($expected, countArguments($input));
    }

    /**
     * @dataProvider positiveDataProviderThreeArg
     */

    public function testPositiveThreeArg($input1, $input2, $input3, $expected)
    {
        $this->assertEquals($expected, countArguments($input1, $input2, $input3));
    }


    public function positiveDataProviderOneArg()
    {
        return [
            [
                'test', [
                'argument_count' => 1,
                'argument_values' => ['test']
            ]
            ],

        ];
    }

    public function positiveDataProviderThreeArg()
    {
        return [
            [
                'test1', 'test2','test3', [
                'argument_count' => 3,
                'argument_values' => ['test1', 'test2', 'test3']
            ]
            ]
        ];
    }
}
