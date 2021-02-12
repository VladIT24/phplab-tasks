<?php
/**
 * The $minute variable contains a number from 0 to 59 (i.e. 10 or 25 or 60 etc).
 * Determine in which quarter of an hour the number falls.
 * Return one of the values: "first", "second", "third" and "fourth".
 * Throw InvalidArgumentException if $minute is negative of greater than 60.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $minute
 * @return string
 * @throws InvalidArgumentException
 */
function getMinuteQuarter(int $minute)
{
    $result = '';
    if ($minute > 60 || $minute < 0) {
        throw new InvalidArgumentException('The number have not to be greater then 60 and not to be a negative');
    }

    switch ($minute) {
        case 0:
        case $minute > 45 && $minute < 60:
            $result = 'fourth';
            break;
        case $minute > 0 && $minute <= 15:
            $result = 'first';
            break;
        case $minute > 15 && $minute <= 30:
            $result = 'second';
            break;
        case $minute > 30 && $minute <= 45:
            $result = 'third';
            break;
    }

    return $result;
}


/**
 * The $year variable contains a year (i.e. 1995 or 2020 etc).
 * Return true if the year is Leap or false otherwise.
 * Throw InvalidArgumentException if $year is lower than 1900.
 * @see https://en.wikipedia.org/wiki/Leap_year
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  int  $year
 * @return boolean
 * @throws InvalidArgumentException
 */
function isLeapYear(int $year)
{
    if ($year < 1900) {
        throw new InvalidArgumentException();
    }


    if ($year % 4 == 0 && $year % 100 != 0) {
        return true;
    }

    if ($year % 400 == 0) {
        return true;
    }

    return false;
}

/**
 * The $input variable contains a string of six digits (like '123456' or '385934').
 * Return true if the sum of the first three digits is equal with the sum of last three ones
 * (i.e. in first case 1+2+3 not equal with 4+5+6 - need to return false).
 * Throw InvalidArgumentException if $input contains more or less than 6 digits.
 * @see https://www.php.net/manual/en/class.invalidargumentexception.php
 *
 * @param  string  $input
 * @return boolean
 * @throws InvalidArgumentException
 */
function isSumEqual(string $input)
{
    if (strlen($input) != 6) {
        throw new InvalidArgumentException();
    }
    $sum1 = $input[0] + $input[1] + $input[2];
    $sum2 = $input[3] + $input[4] + $input[5];

    return $sum1 == $sum2;
}