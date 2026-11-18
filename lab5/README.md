# Laboratorium 5

## Instrukcja uruchomienia
1. Skopiuj katalog `lab5` do `htdocs` w XAMPP.
2. Uruchom serwer Apache w panelu XAMPP.
3. Otwórz w przeglądarce `http://localhost/lab5/index.php`.

## Punkt odniesienia (przed zmianami)
Skopiowano projekt z `lab4` do `htdocs/lab5`. Testy na `http://localhost/lab5/index.html`:
- Filtr katalogu (GET) – działa poprawnie.
- Zapis wyboru do sesji (POST) – działa poprawnie.
- Żądanie AJAX do `status.php` – działa poprawnie.

## Adresy w projekcie
- `index.php` (oraz `index.php?idp=` i `index.php?idp=glowna`) – strona główna
- `index.php?idp=produkt` – produkt
- `index.php?idp=kontakt` – kontakt
- `index.php?idp=filmy` – filmy
- `lab4.php` – katalog PHP
- `status.php` – test AJAX

## Pseudokod wyboru widoku

    Zdefiniuj mapę stron ($strony: klucz -> tytuł, ścieżka w html/)

    Jeśli brak $_GET['idp'] lub $_GET['idp'] == ""
        wybierz 'glowna'
    W przeciwnym razie, jeśli $_GET['idp'] jest tekstem i istnieje w mapie strony
        wybierz klucz z $_GET['idp']
    W przeciwnym razie
        ustaw HTTP 404 i przygotuj komunikat błędu z linkiem do index.php

    Jeśli wybrano klucz:
        zbuduj ścieżkę przez __DIR__ + ścieżka z mapy
        jeśli is_file() i is_readable():
            dołącz plik przez include w <main>
        w przeciwnym razie:
            ustaw HTTP 500 i pokaż komunikat bez ścieżki systemowej

## Wyniki prób

### Próba: Adres domyślny i menu
- **Oczekiwany wynik:** `index.php` i `index.php?idp=` pokazują stronę główną. Odnośniki otwierają właściwe treści ze wspólnym szablonem i poprawnym tytułem.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Nieznany lub tablicowy klucz
- **Oczekiwany wynik:** `?idp=nieznana` i `?idp[]=filmy` dają HTTP 404 i odnośnik powrotny, bez ostrzeżeń PHP.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Próba podania ścieżki
- **Oczekiwany wynik:** `?idp=..%2Fstatus.php` daje HTTP 404. Zawartość `status.php` nie zostaje dołączona.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Brak pliku widoku
- **Oczekiwany wynik:** Zmień tymczasowo nazwę `html/filmy.html`. Adres `?idp=filmy` zwraca HTTP 500 bez ujawnienia ścieżki systemowej.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym (po próbie przywrócono nazwę pliku).

### Próba: Strona główna i AJAX
- **Oczekiwany wynik:** Na stronie głównej działają style, grafiki i animacje. W panelu Sieć widać udane żądanie do `status.php`, a na stronie jego wynik.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Katalog i sesja po migracji
- **Oczekiwany wynik:** Otwórz katalog z menu i użyj filtra. Zapisz poprawny wybór: POST 303, potem GET 200. Wróć na stronę główną, otwórz Filmy i ponownie wejdź do katalogu. Zapisany wybór nadal jest widoczny.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.

### Próba: Filmy i układ mobilny
- **Oczekiwany wynik:** Trzy filmy można uruchomić, odnośniki działają, a przy szerokości 360 px strona nie przewija się w poziomie.
- **Rzeczywisty wynik:** Zgodny z oczekiwanym.