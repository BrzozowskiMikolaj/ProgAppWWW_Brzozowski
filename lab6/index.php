<?php
$identyfikatorProjektu = 'Sklep-Motoryzacyjny';
$pozycjeMenu = [];
$aktywnyKlucz = null;
$strona = null;
$tytulStrony = 'Sklep';
$komunikatBledu = '';

try {
    require_once __DIR__ . '/cfg.php';
    require_once __DIR__ . '/showpage.php';

    $stmtMenu = $pdo->query('SELECT alias, page_title FROM page_list WHERE status = 1 ORDER BY id');
    $pozycjeMenu = $stmtMenu->fetchAll(PDO::FETCH_ASSOC);

    if (!isset($_GET['idp']) || $_GET['idp'] === '') {
        $aktywnyKlucz = 'glowna';
    } elseif (is_string($_GET['idp']) && preg_match('/^[a-z0-9-]{1,20}$/', $_GET['idp'])) {
        $aktywnyKlucz = $_GET['idp'];
    }

    if ($aktywnyKlucz !== null) {
        $strona = PokazPodstrone($pdo, $aktywnyKlucz);
    }

    if ($strona !== null) {
        $tytulStrony = $strona['page_title'];
    } else {
        http_response_code(404);
        $aktywnyKlucz = null;
        $tytulStrony = 'Nie znaleziono strony (404)';
        $komunikatBledu = '<h2>Błąd 404 – Nie znaleziono podstrony</h2>'
            . '<p>Wybrany widok nie istnieje lub nie został opublikowany.</p>'
            . '<p><a href="index.php">Wróć na stronę główną</a></p>';
    }
} catch (PDOException $e) {
    error_log('Błąd bazy danych w index.php: ' . $e->getMessage());
    http_response_code(500);
    $aktywnyKlucz = null;
    $strona = null;
    $tytulStrony = 'Błąd serwera (500)';
    $komunikatBledu = '<h2>Błąd 500 – Błąd serwera</h2>'
        . '<p>Nie udało się pobrać danych. Spróbuj ponownie później.</p>'
        . '<p><a href="index.php">Odśwież stronę</a></p>';
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
        <?php foreach ($pozycjeMenu as $pozycja): ?>
            <a href="index.php?idp=<?php echo urlencode($pozycja['alias']); ?>"<?php echo ($pozycja['alias'] === $aktywnyKlucz) ? ' aria-current="page"' : ''; ?>>
                <?php echo htmlspecialchars($pozycja['page_title'], ENT_QUOTES, 'UTF-8'); ?>
            </a>
        <?php endforeach; ?>
        <a href="lab4.php">Katalog PHP</a>
    </nav>
</header>
<main>
    <?php
    if ($strona !== null) {
        echo $strona['page_content'];
    } else {
        echo $komunikatBledu;
    }
    ?>
</main>
<footer>
    <p>&copy; 2026 Sklep. Wykonał: Mikołaj Brzozowski | Projekt: <?php echo $identyfikatorProjektu; ?> | Wersja: v1.5</p>
</footer>
</body>
</html>