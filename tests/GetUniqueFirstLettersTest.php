<?php


use PHPUnit\Framework\TestCase;

class GetUniqueFirstLettersTest extends TestCase
{
    /**
     * @dataProvider positiveDataProvider
     */

    public function testPositive($data, $expected)
    {
        $this->assertEquals($expected, getUniqueFirstLetters($data));
    }

    public function positiveDataProvider()
    {
        return [
            [[], []],
            [
                [
                    ['name' => 'test'],
                    ['name' => 'test2'],
                    ['name' => 'one'],
                    ['name' => 'red']
                ], ['o', 'r', 't']
            ],
            [
                [
                    ['name' => 'Brown'],
                    ['name' => 'Grey'],
                    ['name' => 'Green'],
                    ['name' => 'Purple']
                ], ['B', 'G', 'P']
            ],
            [
                [
                    ['name' => 'alias']
                ], ['a']
            ]
        ];
    }

}
