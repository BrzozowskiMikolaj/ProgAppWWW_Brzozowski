# Testy

**Środowisko testowe:**

* Przeglądarka: Google Chrome (Wersja 156.0.8078.49)

## 1. Motyw i nawigacja

* **Oczekiwany wynik:** Zmiana motywu utrzymuje się po odświeżeniu i zmianie podstrony; atrybut `aria-pressed` odpowiada stanowi.
* **Zaobserwowany wynik:** Po odświeżeniu strony i przejściu na inną podstronę wybrany motyw pozostaje aktywny. Atrybut `aria-pressed` odpowiada aktualnemu stanowi przycisku.
* **Wykryte błędy i poprawki:** Brak błędów.

## 2. Start trzy razy potem Stop i Start

* **Oczekiwany wynik:** Działa jeden interwał; Stop zatrzymuje aktualizację, a wznowienie pokazuje aktualny czas.
* **Zaobserwowany wynik:** Zegar aktualizuje się co sekundę i nie przyspiesza po wielokrotnym kliknięciu Start. Przycisk Stop poprawnie przerywa działanie.
* **Wykryte błędy i poprawki:** Brak błędów.

## 3. Fragment nazwy ze spacjami i inną wielkością liter

* **Oczekiwany wynik:** Pasujące karty pozostają widoczne; licznik wyników zgadza się z widokiem.
* **Zaobserwowany wynik:** Karty są poprawnie filtrowane niezależnie od użytej wielkości liter oraz po usunięciu białych znaków. Licznik aktualizuje się na żywo.
* **Wykryte błędy i poprawki:** Brak błędów.

## 4. Brak dopasowania i wyczyszczenie pola

* **Oczekiwany wynik:** Pojawia się komunikat o braku wyników; wyczyszczenie pola wyszukiwarki przywraca wszystkie karty.
* **Zaobserwowany wynik:** Komunikat `Brak produktow pasujacych do wyszukiwania` poprawnie pojawia się i znika. Wyczyszczenie pola przywraca domyślny widok produktów.
* **Wykryte błędy i poprawki:** Brak błędów.

## 5. Cena 1999 gr oraz ilość 3

* **Oczekiwany wynik:** Wynik wynosi 59,97 zł; funkcja obliczeniowa działa poprawnie i nie odwołuje się bezpośrednio do DOM.
* **Zaobserwowany wynik:** Wyświetla się poprawnie sformatowana kwota dzięki `Intl.NumberFormat`. Dla ceny 1999 gr i ilości 3 funkcja zwraca 59,97 zł. Można ją też uruchomić w konsoli DevTools bez bezpośredniego odwoływania się do DOM.
* **Wykryte błędy i poprawki:** Brak błędów.

## 6. Ilość pusta 0 6 oraz 1,5

* **Oczekiwany wynik:** Wycena nie pokazuje błędnej (NaN/ujemnej) wartości; formularz blokuje przejście do poprawnego podsumowania.
* **Zaobserwowany wynik:** Formularz blokuje wysłanie z powodu wbudowanych ograniczeń HTML oraz skryptu JS, pojawia się instrukcja tekstowa.
* **Wykryte błędy i poprawki:** Brak błędów.

## 7. Dziesięć spacji oraz tekst <b>Test</b>

* **Oczekiwany wynik:** Same spacje zostają odrzucone; poprawna wiadomość ze znacznikami HTML jest wyświetlana dosłownie jako bezpieczny tekst.
* **Zaobserwowany wynik:** Formularz odrzuca puste spacje dzięki funkcji `trim()`. Znaczniki HTML wyświetlają się bezpiecznie jako zwykły tekst, ponieważ użyto właściwości `textContent` zamiast `innerHTML`.
* **Wykryte błędy i poprawki:** Brak błędów.

## 8. Klawiatura widoki i wyłączony JavaScript

* **Oczekiwany wynik:** Kontrolki działają z poziomu klawiatury przy 375 px i 1280 px; po wyłączeniu JS katalog, treść i menu pozostają dostępne.
* **Zaobserwowany wynik:** Formularz i przyciski są w pełni dostępne z klawiatury (Tab, Space, Enter). Brak JavaScriptu nie psuje struktury strony. Po ukryciu karty za pomocą atrybutu hidden nie jest ona wyświetlana, ponieważ dodano regułę `[hidden] { display: none !important; }`.
* **Wykryte błędy i poprawki:** Brak błędów.
