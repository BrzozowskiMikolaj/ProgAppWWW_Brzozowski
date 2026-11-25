<?php
    session_start();
    require_once __DIR__ . '/includes/produkty.php';
    $komunikatFiltra="";
    $filtrKategorii=null;

    if (isset($_GET['kategoria'])) {
        $kat = $_GET['kategoria'];
        if (is_array($kat) || !in_array($kat, ['wszystkie', 'ksiazki', 'akcesoria'])) {
            $komunikatFiltra = "<p class='komunikat-blad'>Nieprawidłowa kategoria. Wyświetlam pełną listę.</p>";
            $filtrKategorii = null;
        } else {
            if ($kat === 'wszystkie') {
                $filtrKategorii = null;
            } else {
                $filtrKategorii = $kat;
            }
        }
    }

    $bladKoszyka = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['produkt']) || !isset($_POST['ilosc']) || is_array($_POST['produkt']) || is_array($_POST['ilosc'])) {
            http_response_code(400);
            $bladKoszyka = "Błąd: Brak wymaganych pól formularza.";
        } else {
            $idWejsciowe = filter_var($_POST['produkt'], FILTER_VALIDATE_INT);
            $iloscWejsciowa = filter_var($_POST['ilosc'], FILTER_VALIDATE_INT);
            if ($idWejsciowe === false || $iloscWejsciowa === false) {
                http_response_code(400);
                $bladKoszyka = "Błąd: Przesłane dane muszą być liczbami całkowitymi.";
            } else {
                $znalezionyProdukt = null;
                foreach ($produkty as $p) {
                    if ($p['id'] === $idWejsciowe) {
                        $znalezionyProdukt = $p;
                        break;
                    }
                }
                if ($znalezionyProdukt === null) {
                    http_response_code(400);
                    $bladKoszyka = "Błąd: Wskazany produkt nie istnieje.";
                } else {
                    if ($iloscWejsciowa < 1 || $iloscWejsciowa > 5 || $iloscWejsciowa > $znalezionyProdukt['stan']) {
                        http_response_code(400);
                        $bladKoszyka = "Błąd: Nieprawidłowa ilość towaru. Sprawdź dostępność.";
                    } else {
                        $_SESSION['ostatni_wybor'] = [
                            'id' => $idWejsciowe,
                            'ilosc' => $iloscWejsciowa
                        ];
                        header("Location: lab4.php", true, 303);
                        exit;
                    }
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog PHP</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
    include __DIR__ . '/includes/naglowek.php';
?>
    <nav>
        <a href="index.php">Strona Główna</a>
    </nav>

    <main>
        <?php
        $identyfikatorGrupy="GrupaLab4";
        echo "<h2>Katalog PHP</h2>";
        echo "<p>Identyfikator grupy: ". $identyfikatorGrupy."</p>";
        echo "<hr>";
        echo "<form action='lab4.php' method='get'>";
        echo "<label for='kategoria'>Filtruj po kategorii: </label>";
        echo "<select name='kategoria' id='kategoria'>";
        echo "<option value='wszystkie'>Wszystkie</option>";
        echo "<option value='ksiazki'>Książki</option>";
        echo "<option value='akcesoria'>Akcesoria</option>";
        echo "</select>";
        echo "<button type='submit'>Filtruj</button>";
        echo "</form>";

        if ($komunikatFiltra !== "") {
            echo $komunikatFiltra;
        }
        echo "<hr>";
        if ($bladKoszyka !== "") {
            echo "<p class='komunikat-blad'>" . $bladKoszyka . "</p>";
        }
        echo "<h2>Twój ostatni wybór:</h2>";
        if (isset($_SESSION['ostatni_wybor'])) {
            $wybraneId = $_SESSION['ostatni_wybor']['id'];
            $wybranaIlosc = $_SESSION['ostatni_wybor']['ilosc'];
            $wybranaNazwa = "Nieznany produkt";
            foreach ($produkty as $p) {
                if ($p['id'] === $wybraneId) {
                    $wybranaNazwa = $p['nazwa'];
                    break;
                }
            }
            $bezpiecznaNazwa = htmlspecialchars($wybranaNazwa, ENT_QUOTES, 'UTF-8');
            echo "<p class='komunikat-sukces'>Wybrano: <strong>" . $bezpiecznaNazwa . "</strong> (sztuk: " . $wybranaIlosc . ")</p>";
        } else {
            echo "<p>Brak zapisanego wyboru w koszyku.</p>";
        }
        echo "<hr>";
        $i=0;
        $liczbaProduktow = count($produkty);
        while ($i < $liczbaProduktow) {
            $produkt = $produkty[$i];
            if ($filtrKategorii === null || $produkt["kategoria"] === $filtrKategorii) {
                echo "<article class='karta-php'>";
                echo "<h3>" . htmlspecialchars($produkt['nazwa'], ENT_QUOTES, 'UTF-8') . "</h3>";
                switch ($produkt['kategoria']) {
                    case 'ksiazki':
                        $etykieta = "Książki";
                        break;
                    case 'akcesoria':
                        $etykieta = "Akcesoria";
                        break;
                    default:
                        $etykieta = "Inne";
                }
                echo "<p>Kategoria: <strong>" . $etykieta . "</strong></p>";
                if ($produkt['stan'] == 0) {
                    echo "<p class='stan-niedostepny'>Niedostępny</p>";
                } elseif ($produkt['stan'] >= 1 && $produkt['stan'] <= 5) {
                    echo "<p class='stan-niski'>Niski stan (" . $produkt['stan'] . " szt.)</p>";
                } else {
                    echo "<p class='stan-dostepny'>Dostępny (" . $produkt['stan'] . " szt.)</p>";
                }

                if ($produkt['stan'] > 0) {
                    echo "<form action='lab4.php' method='POST'>";
                    echo "<input type='hidden' name='produkt' value='" . $produkt['id'] . "'>";
                    echo "<label for='ilosc-" . $produkt['id'] . "'>Wybierz ilość: </label>";
                    echo "<select name='ilosc' id='ilosc-" . $produkt['id'] . "'>";

                    for ($j = 1; $j <= 5; $j++) {
                        echo "<option value='$j'>$j</option>";
                    }

                    echo "</select>";
                    echo "<button type='submit'>Dodaj do koszyka</button>";
                    echo "</form>";
                }

                echo "</article>";

            }
            $i++;
        }
        ?>
    </main>


</body>
</html>