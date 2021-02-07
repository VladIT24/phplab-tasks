<?php


namespace src\oop\Commands;


class ExpCommand implements CommandInterface
{

    /**
     * @inheritDoc
     */
    public function execute(...$args)
    {
        if (2 != sizeof($args)) {
            throw new \InvalidArgumentException('Not enough parameters');
        }

        return $args[0] ** $args[1];
    }
}