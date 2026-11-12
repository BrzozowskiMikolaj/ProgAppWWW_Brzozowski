# Laboratorium 4 - Katalog PHP i obsługa sesji

## 1. Instrukcja uruchomienia
    
1. Pobierz lub skopiuj cały folder projektu.
2. Przenieś folder z projektem do katalogu `htdocs` serwera XAMPP (domyślnie `C:\xampp\htdocs\lab4`).
3. Uruchom **XAMPP Control Panel** i wystartuj moduł **Apache**.
4. Otwórz przeglądarkę internetową i przejdź pod adres: `http://localhost/lab4/`
5. Z poziomu strony głównej (`index.html`) kliknij link "Katalog PHP" w nawigacji, aby przejść do pliku `lab4.php` i przetestować sklep.

## 2. Pseudokod logiki głównego pliku (lab4.php)
```text
ROZPOCZNIJ sesję (session_start)
WCZYTAJ tablicę z produktami (includes/produkty.php)

// Obsługa filtra GET
JEŚLI odebrano parametr 'kategoria' przez GET:
    JEŚLI kategoria jest nieznana LUB jest tablicą:
        Ustaw filtr na "wszystkie"
        Przygotuj komunikat o błędzie (czerwony tekst)
    W PRZECIWNYM WYPADKU:
        Ustaw filtr na wybraną kategorię

// Obsługa koszyka POST
JEŚLI żądanie to POST:
    ZWALIDUJ pola 'produkt' (ID) i 'ilosc' jako liczby całkowite
    JEŚLI walidacja się nie powiedzie LUB brakuje pól:
        Zwróć błąd HTTP 400 i komunikat
    W PRZECIWNYM WYPADKU:
        ZNAJDŹ produkt po ID w tablicy
        JEŚLI produkt nie istnieje LUB żądana ilość > stan magazynowy LUB ilość nie jest w przedziale 1-5:
            Zwróć błąd HTTP 400 i komunikat
        W PRZECIWNYM WYPADKU:
            ZAPISZ ID produktu i ilość w $_SESSION['ostatni_wybor']
            PRZEKIERUJ użytkownika (HTTP 303) na lab4.php
            ZAKOŃCZ skrypt (exit)

// Generowanie widoku HTML
DOŁĄCZ nagłówek strony (includes/naglowek.php)
WYŚWIETL identyfikator grupy i tytuł
WYŚWIETL formularz filtra kategorii (metoda GET)
WYŚWIETL błędy formularza (jeśli wystąpiły)
WYŚWIETL ostatnio wybrany produkt z sesji (zabezpiecz nazwę przez htmlspecialchars)

// Generowanie listy produktów
DLA KAŻDEGO produktu w tablicy:
    JEŚLI kategoria produktu pasuje do filtra LUB filtr to "wszystkie":
        UTWÓRZ <article> z danymi produktu
        PRZETŁUMACZ kategorię instrukcją switch
        WYŚWIETL nazwę, kategorię i kolorowy stan dostępności (if/else)
        JEŚLI stan > 0:
            WYŚWIETL formularz dodawania do koszyka (ukryte pole ID, select 1-5 z pętli for, przycisk POST)
```
# Testy działania

## Filtr GET
* **Oczekiwany wynik:** ?kategoria=ksiazki pokazuje tylko książki. Nieznana kategoria lub ?kategoria[]=ksiazki pokazuje pełną listę i komunikat.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

## Poprawny POST i odświeżenie
* **Oczekiwany wynik:** Wybierz dostępny produkt i poprawną ilość. W Network widać POST 303, potem GET 200. Po odświeżeniu i zmianie filtra zapisany wybór pozostaje widoczny.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

## Błędne wartości POST
* **Oczekiwany wynik:** Sprawdź ilość 0, 6, 2.5, 2abc, brak pola, tablicę i nieznany produkt. Każda próba daje HTTP 400 i pozostawia poprzedni wybór.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

## Stan magazynowy
* **Oczekiwany wynik:** Dla produktu ze stanem 1 spróbuj wybrać 2 sztuki. Serwer odrzuca wybór, mimo że 2 mieści się w przedziale 1–5.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

## Odrębna sesja i tekst HTML
* **Oczekiwany wynik:** W nowej sesji, np. w osobnym oknie prywatnym, nie ma wyboru. Nazwa testowa <b>Test</b> wyświetla się jako tekst; przywróć zwykłą nazwę.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.

## Strona po zmianie ścieżek
* **Oczekiwany wynik:** Otwórz stronę główną i podstrony. Działają style, obrazy, linki i funkcje z lab3, w tym animacje i żądanie do status.php.
* **Rzeczywisty wynik:** Zgodny z oczekiwanym.