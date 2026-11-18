<?php
    $identyfikatorProjektu = 'Sklep-Motoryzacyjny';
    $strony = [
        'glowna'  => ['tytul' => 'Katalog', 'plik' => 'html/glowna.html'],
        'produkt' => ['tytul' => 'Produkt', 'plik' => 'html/produkt.html'],
        'kontakt' => ['tytul' => 'Kontakt', 'plik' => 'html/kontakt.html'],
        'filmy'   => ['tytul' => 'Filmy',   'plik' => 'html/filmy.html']
    ];
    $aktywnyKlucz = null;
    $plikDoDolaczenia = null;
    $tytulStrony = 'Sklep';
    $komunikatBledu = '';
    if (!isset($_GET['idp']) || $_GET['idp'] === '') {
        $aktywnyKlucz = 'glowna';
    } elseif (is_string($_GET['idp']) && array_key_exists($_GET['idp'], $strony)) {
        $aktywnyKlucz = $_GET['idp'];
    } else {
        http_response_code(404);
        $tytulStrony = 'Nie znaleziono strony (404)';
        $komunikatBledu = '<h2>Błąd 404 – Nie znaleziono podstrony</h2>'.'<p>Wybrany widok nie istnieje.</p>'.'<p><a href="index.php">Wróć na stronę główną</a></p>';
    }
    if ($aktywnyKlucz !== null) {
        $wybrana = $strony[$aktywnyKlucz];
        $tytulStrony = $wybrana['tytul'];
        $pelnaSciezka = __DIR__ . '/' . $wybrana['plik'];

        if (is_file($pelnaSciezka) && is_readable($pelnaSciezka)) {
            $plikDoDolaczenia = $pelnaSciezka;
        } else {
            http_response_code(500);
            $tytulStrony = 'Błąd serwera (500)';
            $komunikatBledu = '<h2>Błąd 500 – Błąd serwera</h2>'
                . '<p>Nie udało się wczytać wybranego widoku. Spróbuj ponownie później.</p>'
                . '<p><a href="index.php">Wróć na stronę główną</a></p>';
        }
    }
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($tytulStrony, ENT_QUOTES, 'UTF-8'); ?> - Sklep</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="js/main.js" defer></script>
    <script src="vendor/jquery-4.0.0.min.js" defer></script>
    <script src="js/lab3.js" defer></script>
</head>
<body>
<header>
    <button type="button" id="theme-button" aria-pressed="false">Tryb ciemny</button>
    <h1>Sklep Motoryzacyjny</h1>
    <nav>
        <?php foreach ($strony as $klucz => $dane): ?>
            <a href="index.php?idp=<?php echo urlencode($klucz); ?>"<?php echo ($klucz === $aktywnyKlucz) ? ' aria-current="page"' : ''; ?>>
                <?php echo htmlspecialchars($dane['tytul'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endforeach; ?>
        <a href="lab4.php">Katalog PHP</a>
    </nav>
</header>
<main>
    <?php
    if ($plikDoDolaczenia !== null) {
        include $plikDoDolaczenia;
    } else {
        echo $komunikatBledu;
    }
    ?>
</main>
<footer>
    <p>&copy; 2026 Sklep. Wykonał: Mikołaj Brzozowski | Projekt: <?php echo $identyfikatorProjektu; ?></p>
</footer>
</body>
</html>