<?php
/**
 * The $input variable contains an array of digits
 * Return an array which will contain the same digits but repetitive by its value
 * without changing the order.
 * Example: [1,3,2] => [1,3,3,3,2,2]
 *
 * @param array $input
 * @return array
 */
function repeatArrayValues(array $input)
{
    $result_arr = array();

    foreach ($input as $item) {
        for ($i = 0; $i < $item; $i++) {
            array_push($result_arr, $item);
        }
    }

    return $result_arr;
}

/**
 * The $input variable contains an array of digits
 * Return the lowest unique value or 0 if there is no unique values or array is empty.
 * Example: [1, 2, 3, 2, 1, 5, 6] => 3
 *
 * @param array $input
 * @return int
 */
function getUniqueValue(array $input)
{
    $count_arr = array_count_values($input);

    foreach ($count_arr as $k => $v) {
        if ($v == 1) {
            return $k;
        }
    }
    return 0;
}

/**
 * The $input variable contains an array of arrays
 * Each sub array has keys: name (contains strings), tags (contains array of strings)
 * Return the list of names grouped by tags
 * !!! The 'names' in returned array must be sorted ascending.
 *
 * Example:
 * [
 *  ['name' => 'potato', 'tags' => ['vegetable', 'yellow']],
 *  ['name' => 'apple', 'tags' => ['fruit', 'green']],
 *  ['name' => 'orange', 'tags' => ['fruit', 'yellow']],
 * ]
 *
 * Should be transformed into:
 * [
 *  'fruit' => ['apple', 'orange'],
 *  'green' => ['apple'],
 *  'vegetable' => ['potato'],
 *  'yellow' => ['orange', 'potato'],
 * ]
 *
 * @param array $input
 * @return array
 */
function groupByTag(array $input)
{
    $tags_arr = [];
    $result_arr = [];

    for ($i = 0; $i < count($input); $i++) {
        $tags = $input[$i]['tags'];
        foreach ($tags as $tag) {
            if (!in_array($tag, $tags_arr)) {
                array_push($tags_arr, $tag);
            }
        }
    }

    foreach ($tags_arr as $tag) {
        foreach ($input as $item) {
            if (in_array($tag, $item['tags'])) {
                $result_arr[$tag][] = $item['name'];
            }
        }
    }

    ksort($result_arr);

    foreach ($result_arr as $k => $v) {
        sort($v);
        $result_arr[$k] = $v;
    }

    return $result_arr;
}