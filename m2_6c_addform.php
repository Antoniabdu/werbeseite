<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>addform</title>
</head>
<body>

<form method="get">
    <label for="a">a:</label>
    <input type="nummer" name="a" id="a" required><br><br>

    <label for="b">b:</label>
    <input type="nummer" name="b" id="b" required><br><br>

    <button type="submit" name="operator" value="addieren">Addieren</button>
    <button type="submit" name="operator" value="multiplizieren">Multiplizieren</button>
</form>

<?php
/**
 * Praktikum DBWT. Autoren:
 * Antonia, Badelt, 3728150
 * Alice, Kelberer, 3731224
 */
if (isset($_GET['a']) && isset($_GET['b']) && isset($_GET['operator'])) {
    $a = $_GET['a'];
    $b = $_GET['b'];
    $operation = $_GET['operator'];

    if ($operation == 'addieren') {
        $result = $a + $b;
        echo "<p>Ergebnis der Addition: $result</p>";
    } elseif ($operation == 'multiplizieren') {
        $result = $a * $b;
        echo "<p>Ergebnis der Multiplikation: $result</p>";
    }
}
?>

</body>
</html>
