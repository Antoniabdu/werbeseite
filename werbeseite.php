<?php


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Benutzereingaben
    $name = trim($_POST['vorname']); //$_POST["vorname"] ?? '': Holt den Namen aus dem Formular
    $email = trim($_POST['e-mail']); //$_POST["e-mail"] ?? '': Holt die E-mail aus dem Formular
    $newsletterSprache = $_POST['newsletter'];
    $datenschutz = isset($_POST['datenschutz']); // Checkbox wird als true übermittelt, wenn aktiviert

    // Fehlerprüfungen
    $fehler = []; //Leeres Array, in dem mögliche Fehlermeldungen gesammelt werden.


    if ($name === '' || strlen(trim($name)) === 0) {
        $fehler[] = "Bitte geben Sie einen gültigen Namen ein.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $fehler[] = "Ihre E-Mail-Adresse ist ungültig."; //filter_var() mit dem Filter FILTER_VALIDATE_EMAIL prüft, ob die E-Mail gültig ist
    }
    if (preg_match('/@(trashmail\.com|trashmail\.de|wegwerfmail\.de)$/', $email)) { //preg_match() sucht nach einem bestimmten Muster in einer Zeichenkette und gibt zurück, ob das Muster gefunden wurde oder nicht.
        $fehler[] = "Bitte verwenden Sie keine Wegwerf-E-Mail-Adressen.";
    }
    if (!$datenschutz) {
        $fehler[] = "Sie müssen den Datenschutzbestimmungen zustimmen.";
    }

    if (empty($fehler)) {
        // Daten in einer Textdatei speichern
        $eintrag = "$name, $email, $newsletterSprache\n";

        // Datei anhängen (TEXTDATEI)
        file_put_contents("newsletter_anmeldungen.txt", $eintrag, FILE_APPEND);

        echo "Vielen Dank für Ihre Anmeldung!";
    } else {
        // Fehler ausgeben
        foreach ($fehler as $error) {
            echo $error . "<br>";
        }
    }
}


?>
<!DOCTYPE html>
<!--
    - Praktikum DBWT. Autoren:
    - Alice, Kelberer, 3731224
    - Antonia, Badelt, 3728150
-->
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>E-Mensa</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css" />
</head>
<body>

<header>
    <nav class="navbar">
        <ul>
            <li><a href="#Ankündigungen">Ankündigungen</a></li>
            <li><a href="#Speisen">Speisen</a></li>
            <li><a href="#zahlen">Zahlen</a></li>
            <li><a href="#kontakt">Newsletter</a></li>
            <li><a href="#wichtigfueruns">Wichtig für uns</a></li>
        </ul>
    </nav>
</header>

<main>
    <div class="titelbild">
        <h1>E-Mensa</h1>
    </div>
    <section id="Neuigkeiten">
        <div id="Ankündigungen">
           <h2>Bald gibt es auch Essen online!</h2>
           <p class="ankündigungenInfoText">Wir freuen uns, dir mitteilen zu können, dass du dein Essen bei der E-Mensa bald auch online vorbestellen kannst! Damit wird dein Mensa-Besuch noch bequemer, schneller und moderner.
            Egal ob vom Laptop zu Hause oder vom Handy unterwegs – du kannst schon im Voraus sehen, was es gibt, und dein Lieblingsgericht mit nur wenigen Klicks sichern.
            Wartezeiten in der Schlange gehören damit bald der Vergangenheit an.<br> Unsere neue Online-Plattform sorgt dafür, dass du dein Essen zum gewünschten Zeitpunkt frisch zubereitet bekommst
            – perfekt, wenn du einen vollen Stundenplan hast oder einfach keine Zeit verlieren willst.</p>
        </div>
        <?php echo "Test"; ?>

        <?php include 'meals.php'; ?>

        <table>
            <tr>
                <th>Bild</th>
                <th>Gericht</th>
                <th>Preis intern</th>
                <th>Preis extern</th>
            </tr>
            <?php foreach ($meals as $meal): ?>
                <tr>
                    <td><img src="img/<?php echo $meal['image']; ?>" alt="<?php echo htmlspecialchars($meal['name']); ?>" style="width: 100px; height: 100px;"></td>
                    <td><?php echo htmlspecialchars($meal['name']); ?></td>
                    <td><?php echo number_format($meal['price_intern'], 2, ',', '') . '€'; ?></td>
                    <td><?php echo number_format($meal['price_extern'], 2, ',', '') . '€'; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>


        <div id="zahlen">

    <div class="zahlenueberschrift">
        <h2>E-Mensa in Zahlen</h2>
    </div>
      <div class="zahlen-container">
         <div class="zahlen">x Besuche</div>
         <div class="zahlen">y Anmeldungen zum Newsletter</div>
         <div class="zahlen">z Speisen</div>
      </div>
    </div>

    <div id="kontakt">
      <div class="kontaktueberschrift">
        <h2>Interesse geweckt? Wir informieren Sie!</h2>
      </div>

        <form method="POST" action="werbeseite.php">
            <fieldset class="formularrand">
                <label for="vornamefeld">Ihr Name:*</label><br>
                <input type="text" id="vornamefeld" name="vorname" maxlength="20" placeholder="Vorname" required><br><br>

                <label for="e-Mail">Ihre E-Mail*</label><br>
                <input type="email" id="e-Mail" name="e-mail" maxlength="40" placeholder="vorname.nachname@alumni.fh-aachen.de" required><br><br>

                <label>Newsletter bitte in:</label>
                <select name="newsletter">
                    <option value="1">Deutsch</option>
                    <option value="2">Englisch</option>
                    <option value="3">Russisch</option>
                    <option value="4">Französisch</option>
                    <option value="5">Chinesisch</option>
                </select><br><br>

                <input type="checkbox" id="datenschutz" name="datenschutz" value="1" required>
                <label for="datenschutz">Den Datenschutzbestimmungen stimme ich zu*</label><br><br>

                <input type="submit" value="Zum Newsletter anmelden"><br><br>

                <label>* Eingaben sind Pflicht</label>
            </fieldset>
        </form>

    </div>

        <div id="wichtigfueruns">
         <div class="wichtigueberschrift">
            <h2>Das ist uns wichtig</h2>
         </div>

    <div class="wichtig">
        <ul>
            <li>Beste frische saisonale Zutaten</li>
            <li>Ausgewogene abwechslungsreiche Gerichte</li>
            <li>Sauberkeit</li>
        </ul>
    </div>
        </div>
   <div class="besuch">
        <h2>Wir freuen uns auf Ihren Besuch!</h2>
   </div>
    </section>
</main>



<footer>
    <ul>
        <li>(c) E-Mensa GmbH</li>
        <li>Alice Kelberer & Antonia Badelt </li>
        <li>Impressum</li>
    </ul>
</footer>



</body>
</html>