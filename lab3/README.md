# Sklep motoryzacyjny

**Wykorzystana wersja jQuery:** 4.0.0 (wersja pełna, zminimalizowana)

## Instrukcja uruchomienia

**Sposób 1: Serwer lokalny Python**

1. Otwórz terminal systemu wewnątrz katalogu `lab1/`.
2. Uruchom polecenie  `py -m http.server 8000` lub `python -m http.server 8000`.
3. Otwórz przeglądarkę internetową i przejdź pod adres `http://localhost:8000/`.

**Sposób 2: Wbudowany serwer PhpStorm**

1. Otwórz projekt w środowisku PhpStorm.
2. Otwórz plik `index.html`.
3. W prawym górnym rogu edytora najedź na pasek i kliknij ikonę wybranej przeglądarki.

**Sposób 3: Lokalny serwer XAMPP (Wymagany do PHP i AJAX)**

1. Uruchom serwer WWW obsługujący PHP (np. moduł Apache w XAMPP) na standardowym porcie (80).
2. Umieść folder z projektem (`lab3`) w głównym katalogu publicznym serwera ( `C:\xampp\htdocs\lab3`).
3. Otwórz przeglądarkę i przejdź pod adres `http://localhost/lab3/`.
4. Aby zweryfikować środowisko, otwórz `http://localhost/lab3/status.php` (na stronie wyświetli się "PHP działa").

# Testy

**Środowisko testowe:**

* Przeglądarka: Google Chrome (Wersja 157.0.8103.39)

## 1.Szybkie kliknięcia A

* **Kroki:** Kliknięcie `Resetuj A i C`, a następnie 10 szybkich kliknięć w `Przycisk 1`.
* **Wynik oczekiwany:** Po resecie i 10 kliknięciach stan bazowy; po zakończeniu klikania animacje nie odtwarzają zaległej kolejki.
* **Wynik rzeczywisty:** Zgodny z oczekiwanym.

## 2.Kursor i fokus B

* **Kroki:** Najechanie kursorem na `Przycisk 2`, kliknięcie, odsunięcie kursora i kliknięcie pustego tła.
* **Wynik oczekiwany:** Wyjście kursora przy zachowanym fokusie nie zmniejsza obiektu. Utrata obu stanów przywraca rozmiar bazowy.
* **Wynik rzeczywisty:** Zgodny z oczekiwanym.

## 3.Limit i reset C

* **Kroki:** Powolne kliknięcie `Przycisku 3` pięć razy, następnie szósty i siódmy raz. Rozpoczęcie kolejnej animacji i reset w jej trakcie.
* **Wynik oczekiwany:** Pięć kroków daje 260 × 140 px. Dalsze kliknięcia nie powiększają obiektu; reset podczas animacji zeruje stan.
* **Wynik rzeczywisty:** Zgodny z oczekiwanym.

## 4.Klawiatura i ruch

* **Kroki:** Nawigacja po stronie za pomocą klawisza Tab. Użycie Enter lub Spacji na przyciskach A, C oraz Resecie. Przeładowanie strony po włączeniu symulacji `prefers-reduced-motion: reduce` w DevTools.
* **Wynik oczekiwany:** Tab dociera do przycisków; Enter i Spacja obsługują A, C i reset. Ograniczenie ruchu wyłącza przejścia, zachowując funkcje.
* **Wynik rzeczywisty:** Zgodny z oczekiwanym.

## 5. Pierwsze żądanie AJAX

* **Kroki:** Wysłanie żądania GET do `status.php`. Weryfikacja kodu 200 w zakładce Network. Tymczasowa zmiana nazwy pliku na serwerze w celu wymuszenia i sprawdzenia błędu 404. Weryfikacja stanu ładowania przy symulowanej wolnej sieci (Slow 3G).
* **Wynik
  oczekiwany:** Wyświetlenie „Ładowanie...”, blokada przycisku, obsługa sukcesu .done () i błędu .fail (). Przycisk zostaje odblokowany przez .always (). Strona nie przeładowuje się.
* **Wynik rzeczywisty:** Zgodny z oczekiwanym.

# Pseudokody dla logiki aplikacji

**Ustawienia globalne**

* Włączone `prefers-reduced-motion` → wyłącz animacje przez `$.fx.off = true`.

**Animacja A (Przycisk 1)**

* Początkowo `powiekszenie = fałsz`.
* Kliknięcie odwraca stan i aktualizuje `aria-pressed`.
* Powiększenie: 240 × 130 px, zmniejszenie: 160 × 90 px.
* Zatrzymaj kolejkę i animuj przez 300 ms.

**Animacja B (Przycisk 2)**

* Początkowo `najazd = fałsz`, `fokus = fałsz`.
* Najazd lub fokus → 220 × 120 px, w przeciwnym razie 160 × 90 px.
* Zdarzenia `mouseenter`, `mouseleave`, `focus` i `blur` aktualizują stan.
* Zatrzymaj kolejkę i animuj przez 300 ms.

**Animacja C (Przycisk 3)**

* Początkowo `kroki = 0`, rozmiar bazowy 160 × 90 px.
* Przerwij, jeśli trwa animacja lub osiągnięto 5 kroków.
* Zwiększ `kroki` i aktualizuj status.
* Szerokość = 160 + 20 × kroki, wysokość = 90 + 10 × kroki.
* Animuj przez 300 ms.

**Resetowanie**

* Ustaw `powiekszenie = fałsz`, `aria-pressed = false` i `kroki = 0`.
* Zatrzymaj animacje A i C.
* Przywróć rozmiar 160 × 90 px i zaktualizuj status.

**Żądanie AJAX**

* Kliknięcie blokuje przycisk i wyświetla „Ładowanie...”.
* Wyślij żądanie GET do `status.php` z limitem 5 s.
* `.done()` → wyświetl odpowiedź serwera.
* `.fail()` → wyświetl komunikat błędu.
* `.always()` → odblokuj przycisk.
