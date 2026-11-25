# Laboratorium 6 (v1.5)

## Instrukcja uruchomienia
1. Skopiuj katlog `lab6` do `htdocs` w XAMPP.
2. Uruchom usługi **Apache** oraz **MySQL** w panelu XAMPP.
3. W phpMyAdmin zaimportuj kolejno pliki `sql/schema.sql` oraz `sql/seed.sql`.
4. Utwórz lokalnego użytkownika bazy z prawem `SELECT` wyłącznie do tabeli `moja_strona.page_list`.
5. Skopiuj plik `cfg.example.php` jako `cfg.php` i uzupełnij dane dostępu do bazy.
6. Otwórz stronę w przeglądarce pod adresem `http://localhost/lab6/index.php`.

## Punkt odniesienia, przed zmianami
Skopiowano projekt z `lab5` do `htdocs/lab6`. Przed wprowadzeniem zmian sprawdzono na `http://localhost/lab6/index.php`:
* Podstrony z menu - działają poprawnie.
* Katalog PHP (`lab4.php`: filtr GET, formularz POST, sesja) - działa poprawnie.
* Żądanie AJAX do `status.php` - działa poprawnie.

## Pseudokod pobierania podstrony i obsługi błędów

    Zainicjuj puste menu i zmienne widoku
    W bloku try:
        Wczytaj konfigurację PDO (cfg.php) oraz funkcję PokazPodstrone (showpage.php)
        Pobierz z page_list aliasy i tytuły stron ze status = 1 (ORDER BY id) do menu

        Jeśli brak $_GET['idp'] lub $_GET['idp'] == ""
            ustaw alias = 'glowna'
        W przeciwnym razie, jeśli $_GET['idp'] jest tekstem i pasuje do /^[a-z0-9-]{1,20}$/
            ustaw alias = $_GET['idp']
        W przeciwnym razie
            zostaw alias = null

        Jeśli alias != null
            wywołaj PokazPodstrone(pdo, alias) -> SELECT ... WHERE alias = :alias AND status = 1 LIMIT 1

        Jeśli znaleziono stronę
            ustaw tytuł strony i przygotuj jej treść HTML do wyświetlenia w <main>
        W przeciwnym razie
            ustaw HTTP 404 i przygotuj komunikat błędu z linkiem do index.php
    W bloku catch (PDOException):
        Zapisz szczegóły błędu w lokalnym logu (error_log)
        Ustaw HTTP 500 i przygotuj ogólny komunikat błędu bez danych technicznych

    Wygeneruj wspólny szablon HTML (tytuł i etykiety menu przez htmlspecialchars, aktywny link z aria-current="page")


## Wyniki prób

### Próba: Odczyt i aktualizacja treści
* **Oczekiwany wynik:** index.php i ?idp= otwierają glowna z HTTP 200. Zmień treść w phpMyAdmin: po odświeżeniu widać zmianę bez edycji plików PHP i HTML.
* **Rzeczywisty wynik:** Zgodny z oczekwiwanym.

### Próba: Nowa strona i menu
* **Oczekiwany wynik:** Dodaj opublikowany rekord z nowym aliasem. Link pojawia się w menu i otwiera stronę bez zmiany kodu PHP. Aktywny link jest oznaczony.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Szkic i publikacja
* **Oczekiwany wynik:** Rekord ze statusem 0 znika z menu, a jego bezpośredni adres zwraca 404. Po zmianie statusu na 1 jest widoczny. Próba dodania identycznego aliasu
  jest odrzucana przez bazę.

* **Rzeczywisty wynik:** Zgodny z oczekkiwanym.

### Próba: Błędne dane w adresie
* **Oczekiwany wynik:** ?idp=nieznana i ?idp[]=filmy dają 404. Jako idp sprawdź też ../cfg.php oraz tekst ' OR 1=1--. Każda próba daje 404 bez ostrzeżeń PHP.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Awaria bazy
* **Oczekiwany wynik:** Ustaw tymczasowo błędny port w konfiguracji. Strona zwraca 500 bez szczegółów technicznych, a lokalny log pozwala ustalić przyczynę.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym

### Próba: Funkcje po migracji
* **Oczekiwany wynik:** Działają style, obrazy, animacje, AJAX i trzy filmy. Katalog filtruje produkty i zapisuje wybór: POST 303, potem GET 200. Wybór pozostaje po przejściu między podstronami.
* **Rzeczywisty wynik:** Zgodny z oczekiwnym.

### Próba: Odtworzenie środowiska
* **Oczekiwany wynik:** Utwórz pustą bazę testową. Zaimportuj schemat i dane, uzupełnij lokalną konfigurację. Projekt uruchamia się zgodnie z README, także z polskimi znakami.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.