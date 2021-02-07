<?php


namespace src\oop\Commands;


class MulCommand implements CommandInterface
{

    /**
     * @inheritDoc
     */
    public function execute(...$args)
    {
        if (sizeof($args) != 2) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] * $args[1];
    }
}