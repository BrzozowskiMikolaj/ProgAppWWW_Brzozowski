# Sklep motoryzacyjny

## Instrukcja uruchomienia

**Sposób 1: Serwer lokalny Python**

1. Otwórz terminal systemu wewnątrz katalogu `lab1/`.
2. Uruchom polecenie  `py -m http.server 8000` lub `python -m http.server 8000`.
3. Otwórz przeglądarkę internetową i przejdź pod adres `http://localhost:8000/`.

**Sposób 2: Wbudowany serwer PhpStorm**

1. Otwórz projekt w środowisku PhpStorm.
2. Otwórz plik `index.html`.
3. W prawym górnym rogu edytora najedź na pasek i kliknij ikonę wybranej przeglądarki.

## Przepływ danych w aplikacji

1. **Zdarzenie (Event):**
   Skrypt reaguje na zmianę produktu (change), zmianę ilości (input) i wysłanie formularza (submit). Metoda `e.preventDefault ()` zapobiega domyślnemu przeładowaniu strony.

2. **Dane wejściowe (Input):**
   Wartości są pobierane z formularza i sprawdzane. Ilość musi być liczbą całkowitą od 1 do 5, a wiadomość po usunięciu skrajnych spacji przez `trim ()` musi mieć co najmniej 10 znaków.

3. **Obliczenie (Calculation):**
   oblicza wartość bez odwoływania się do DOM. Ceny są przechowywane w groszach, co pozwala uniknąć błędów precyzji obliczeń.

4. **Zmiana DOM (DOM Manipulation):**
   wynik jest formatowany przez `Intl.NumberFormat` dla lokalizacji pl-PL i wyświetlany za pomocą `textContent`. Dzięki temu wpisane znaczniki HTML nie są interpretowane jako kod. Widoczność komunikatów i podsumowania kontroluje atrybut hidden.