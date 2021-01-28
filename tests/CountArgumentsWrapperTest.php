<?php


use PHPUnit\Framework\TestCase;

class CountArgumentsWrapperTest extends TestCase
{
    public function testNegative1()
    {
        $this->expectException(InvalidArgumentException::class);
        countArgumentsWrapper('test', 1);
    }

    public function testNegative2()
    {
        $this->expectException(InvalidArgumentException::class);
        countArgumentsWrapper('test', 'test2', []);
    }

}
