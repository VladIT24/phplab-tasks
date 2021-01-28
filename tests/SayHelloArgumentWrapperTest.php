<?php


use PHPUnit\Framework\TestCase;

class SayHelloArgumentWrapperTest extends TestCase
{
    public function testNegative1()
    {
        $this->expectException(InvalidArgumentException::class);
        sayHelloArgumentWrapper([]);
    }

    public function testNegative2()
    {
        $this->expectException(InvalidArgumentException::class);
        sayHelloArgumentWrapper(null);
    }

}
