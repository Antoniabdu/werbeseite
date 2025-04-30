<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>Famous Meals</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        ol li {
            margin: 20px;
        }
    </style>
</head>
<body>


<?php
/**
 * Praktikum DBWT. Autoren:
 * Antonia, Badelt, 3728150
 * Alice, Kelberer, 3731224
 */
$famousMeals = [
    1 => ['name' => 'Currywurst mit Pommes',
        'winner' => [2001, 2003, 2007, 2010, 2020]],
    2 => ['name' => 'Hähnchencrossies mit Paprikareis',
        'winner' => [2002, 2004, 2008]],
    3 => ['name' => 'Spaghetti Bolognese',
        'winner' => [2011, 2012, 2017]],
    4 => ['name' => 'Jägerschnitzel mit Pommes',
        'winner' => 2019]
];

echo "<ol>"; // geordnete Liste beginnen

foreach ($famousMeals as $meal) {
    echo "<li>" . $meal['name'] . "<br>";

    $years = is_array($meal['winner']) ? $meal['winner'] : [$meal['winner']];

    rsort($years);

    echo implode(", ", $years);
    echo "</li>";
}

echo "</ol>";



function YearsNoWinners($meals) {
    $all = range(2000, 2025);
    $won = [];

    foreach ($meals as $m) {
        $y = is_array($m['winner']) ? $m['winner'] : [$m['winner']];
        $won = array_merge($won, $y);
    }

    return array_diff($all, $won);
}


$missing = YearsNoWinners($famousMeals);
echo "<h3>Jahre ohne Gewinner:</h3>";
echo implode(", ", $missing);

?>


</body>
</html>


