<?php
require_once './functions.php';

$airports = require './airports.php';

// Filtering
/**
 * Here you need to check $_GET request if it has any filtering
 * and apply filtering by First Airport Name Letter and/or Airport State
 * (see Filtering tasks 1 and 2 below)
 */

if (isset($_GET['filter_by_first_letter'])) {
    $airports = array_filter($airports, function ($item) {
        return $item['name'][0] == $_GET['filter_by_first_letter'][0];
    });
}

if (isset($_GET['filter_by_state'])) {
    $airports = array_filter($airports, function ($item) {
        return $item['state'][0] == $_GET['filter_by_state'][0];
    });
}

// Sorting
/**
 * Here you need to check $_GET request if it has sorting key
 * and apply sorting
 * (see Sorting task below)
 */

if (isset($_GET['sort'])) {
    $value = $_GET['sort'];
    usort($airports, function ($item1, $item2) {
        global $value;
        return $item1[$value] <=> $item2[$value];
    });
}


// Pagination
/**
 * Here you need to check $_GET request if it has pagination key
 * and apply pagination logic
 * (see Pagination task below)
 */

$page = $_GET['page'] ?? 1;
$results_per_page = 5;
$curr_page_result = ($page - 1) * $results_per_page;
$number_of_page = ceil(count($airports) / $results_per_page);
$start_of_output = ($page - 1) * $results_per_page;
$airports = array_slice($airports, $start_of_output, $results_per_page);

$_GET['page'] = (int)$page;

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>Airports</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
<main role="main" class="container">

    <h1 class="mt-5">US Airports</h1>

    <!--
        Filtering task #1
        Replace # in HREF attribute so that link follows to the same page with the filter_by_first_letter key
        i.e. /?filter_by_first_letter=A or /?filter_by_first_letter=B

        Make sure, that the logic below also works:
         - when you apply filter_by_first_letter the page should be equal 1
         - when you apply filter_by_first_letter, than filter_by_state (see Filtering task #2) is not reset
           i.e. if you have filter_by_state set you can additionally use filter_by_first_letter
    -->
    <div class="alert alert-dark">
        Filter by first letter:

        <?php foreach (getUniqueFirstLetters(require './airports.php') as $letter): ?>
            <a href="?<?= makeUrl('filter_by_first_letter', $letter, true) ?>"><?= $letter ?></a>
        <?php endforeach; ?>

        <a href="<?= $_SERVER['PHP_SELF'] ?>" class="float-right">Reset all filters</a>
    </div>

    <!--
        Sorting task
        Replace # in HREF so that link follows to the same page with the sort key with the proper sorting value
        i.e. /?sort=name or /?sort=code etc

        Make sure, that the logic below also works:
         - when you apply sorting pagination and filtering are not reset
           i.e. if you already have /?page=2&filter_by_first_letter=A after applying sorting the url should looks like
           /?page=2&filter_by_first_letter=A&sort=name
    -->
    <table class="table">
        <thead>
        <tr>
            <th scope="col"><a href="?<?= makeUrl('sort', 'name') ?>">Name</a></th>
            <th scope="col"><a href="?<?= makeUrl('sort', 'code') ?>">Code</a></th>
            <th scope="col"><a href="?<?= makeUrl('sort', 'state') ?>">State</a></th>
            <th scope="col"><a href="?<?= makeUrl('sort', 'city') ?>">City</a></th>
            <th scope="col">Address</th>
            <th scope="col">Timezone</th>
        </tr>
        </thead>
        <tbody>
        <!--
            Filtering task #2
            Replace # in HREF so that link follows to the same page with the filter_by_state key
            i.e. /?filter_by_state=A or /?filter_by_state=B

            Make sure, that the logic below also works:
             - when you apply filter_by_state the page should be equal 1
             - when you apply filter_by_state, than filter_by_first_letter (see Filtering task #1) is not reset
               i.e. if you have filter_by_first_letter set you can additionally use filter_by_state
        -->
        <?php foreach ($airports as $airport): ?>
            <tr>
                <td><?= $airport['name'] ?></td>
                <td><?= $airport['code'] ?></td>
                <td>
                    <a href="?<?= makeUrl('filter_by_state', $airport['state'][0], true) ?>"><?= $airport['state'] ?></a>
                </td>
                <td><?= $airport['city'] ?></td>
                <td><?= $airport['address'] ?></td>
                <td><?= $airport['timezone'] ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <!--
        Pagination task
        Replace HTML below so that it shows real pages dependently on number of airports after all filters applied

        Make sure, that the logic below also works:
         - show 5 airports per page
         - use page key (i.e. /?page=1)
         - when you apply pagination - all filters and sorting are not reset
    -->
    <nav aria-label="Navigation">
        <ul class="pagination justify-content-center">
            <li class="page-item <?php echo ($page == 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= makeUrl('page', $page - 1) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>

            <?php for ($i = $page - 1; $i < $page + 2; $i++): ?>
                <?php if ($i >= 1 && $i <= $number_of_page): ?>
                    <li class="page-item <?php echo ($page == $i) ? 'active' : ''; ?>">
                        <a href="?<?= makeUrl('page', $i) ?>" class="page-link"><?= $i ?></a>
                    </li>
                <?php endif; ?>
            <?php endfor; ?>

            <?php if ($page < $number_of_page - 1): ?>
                <li class="page-item">
                    <a href="#" class="page-link">...</a>
                </li>
                <li class="page-item">
                    <a href="?<?= makeUrl('page', $number_of_page) ?>" class="page-link"><?= $number_of_page ?></a>
                </li>
            <?php endif; ?>

            <li class="page-item <?php echo ($page == $number_of_page) ? 'disabled' : '' ?>">
                <a class="page-link" href="?<?= makeUrl('page', $page + 1) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

</main>
</html>
