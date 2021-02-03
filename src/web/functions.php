<?php
/**
 * The $airports variable contains array of arrays of airports (see airports.php)
 * What can be put instead of placeholder so that function returns the unique first letter of each airport name
 * in alphabetical order
 *
 * Create a PhpUnit test (GetUniqueFirstLettersTest) which will check this behavior
 *
 * @param array $airports
 * @return string[]
 */
function getUniqueFirstLetters(array $airports): array
{
    $result = [];

    foreach ($airports as $airport) {
        $letter = $airport['name'][0];
        if (!in_array($letter, $result)) {
            array_push($result, $letter);
        }
    }
    sort($result);
    return $result;
}

function makeUrl(string $key, string $value, bool $first_page = false): string
{
    $url_arr = $_GET;
    if ($first_page) {
        $url_arr['page'] = 1;
    }

    $url_arr[$key] = $value;

    return http_build_query($url_arr);
}

