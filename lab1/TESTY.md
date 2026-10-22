# Testy

**Środowisko testowe:**

* Przeglądarka: Google Chrome (Wersja 156.0.8078.48)

## 1. Struktura

**Nu HTML Checker:**

* **Oczekiwany wynik:** Brak błędów i ostrzeżeń w plikach HTML.
* **Zaobserwowany wynik:** Pliki `index.html`, `kontakt.html` oraz `produkt.html` przeszły testy pomyślnie. Przy każdym pliku wyświetlił się napis: `Document checking completed. No errors or warnings to show.`

**Wyłączenie CSS w DevTools:**

* **Oczekiwany wynik:** Strona pozostaje czytelna, ma zachowany logiczny układ i hierarchię nagłówków.
* **Zaobserwowany wynik:** Po usunięciu powiązania z plikiem `style.css` w DevTools, zawartość strony układa się w prawidłowy sposób od góry do dołu (header, nav, main/article, footer) z zachowaniem hierarchii nagłówków.

## 2. Widoki

**Widok 375 px (ekran mobilny):**

* **Oczekiwany wynik:** Układ jednokolumnowy, brak poziomego paska przewijania, wszystkie elementy mieszczą się na ekranie.
* **Zaobserwowany wynik:** Katalog wyświetla jedną kolumnę, zdjęcia zachowują proporcje, a formularz nie wychodzi poza krawędzie ekranu.

**Widok 1280 px (ekran komputera):**

* **Oczekiwany wynik:** Układ trzykolumnowy dla produktów, wyśrodkowanie całej zawartości strony.
* **Zaobserwowany wynik:** Produkty układają się w trzech kolumnach, a główny kontener z treścią jest prawidłowo wyśrodkowany.

**Granica 768 px:**

* **Oczekiwany wynik:** Zmiana układu po przekroczeniu tej szerokości okna.
* **Zaobserwowany wynik:** Reguła `@media` działa prawidłowo. Poniżej 768 px wyświetla się jedna kolumna, a powyżej okno płynnie przechodzi w układ trzykolumnowy.

## 3. Klawiatura

**Nawigacja Tab i Shift+Tab:**

* **Oczekiwany wynik:** Logiczna kolejność przechodzenia przez elementy oraz wyraźnie widoczny fokus.
* **Zaobserwowany wynik:** Klawisze poprawnie przenoszą między polami i linkami, a aktywny element otrzymuje wyraźny obrys.

**Aktywacja linku Enterem:**

* **Oczekiwany wynik:** Wciśnięcie klawisza Enter na zaznaczonym linku otwiera docelową stronę.
* **Zaobserwowany wynik:** Nawigacja klawiaturą wywołuje odpowiednie akcje.

**Kliknięcie etykiety (label):**

* **Oczekiwany wynik:** Kliknięcie tekstu etykiety aktywuje przypisane do niej pole formularza.
* **Zaobserwowany wynik:** Wszystkie etykiety poprawnie przenoszą kursor do właściwych pól.

## 4. Walidacja formularza

**Pusty formularz:**

* **Oczekiwany wynik:** Przeglądarka blokuje wysłanie z powodu pustych pól.
* **Zaobserwowany wynik:** Wyświetla się komunikat o konieczności wypełnienia wymaganego pola.

**Błędny e-mail:**

* **Oczekiwany wynik:** Zablokowanie wysyłki z powodu niepoprawnego formatu adresu.
* **Zaobserwowany wynik:** Przeglądarka informuje o braku znaku "@".

**Wpisanie liczby 0 oraz 6:**

* **Oczekiwany wynik:** Zablokowanie wysyłki, ponieważ wartości wykraczają poza przedział od 1 do 5.
* **Zaobserwowany wynik:** Dla 0 pojawia się komunikat `Wartość nie może być mniejsza niż 1.`, a dla 6 pokazuje się komunikat `Wartość nie może być większa niż 5.`.

**Wiadomość krótsza niż 10 znaków:**

* **Oczekiwany wynik:** Próba zablokowana przez atrybut określający minimalną długość tekstu.
* **Zaobserwowany wynik:** Wyświetla się informacja o wymogu użycia co najmniej 10 znaków.

**Poprawny zestaw danych:**

* **Oczekiwany wynik:** Pomyślne przeładowanie strony i przekazanie wszystkich parametrów do adresu URL.
* **Zaobserwowany wynik:** Formularz został wysłany, a w adresie URL prawidłowo pojawiły się cztery parametry: `email`, `produkt`, `ilosc` oraz `wiadomosc` (np. `?email=aud%40aud&produkt=KluczMilwaukee&ilosc=3&wiadomosc=Czy+ten++klucz+jest+jeszcze+dostepny+w+takiej+ilosci`).

## 5. Eksperyment (Usunięcie atrybutu "name" z pola e-mail)

**Przewidywany efekt:**

* Przewiduję, że bez atrybutu `name` przeglądarka pominie to pole i adres e-mail nie zostanie dołączony do wysyłanych danych.

**Wykonanie i porównanie URL:**

* Z pola e-mail usunięto atrybut `name="email"` (zostawiono samo `id` i etykietę), a następnie wysłano poprawnie wypełniony formularz.
* **Zaobserwowany wynik:** W adresie URL po wysłaniu formularza zabrakło parametru email. Link zawierał jedynie pozostałe dane (np. `?produkt=KluczMilwaukee&ilosc=3&wiadomosc=Czy+ten++klucz+jest+jeszcze+dostepny+w+takiej+ilosci`).

**Wyjaśnienie:**

* Atrybut `id` pozwala powiązać pole z etykietą, natomiast `name` określa nazwę parametru wysyłanego w formularzu. Bez niego przeglądarka pomija wartość tego pola podczas wysyłania danych.

**Weryfikacja w DevTools:**

* Atrybut `name="email"` został przywrócony.
* W zakładce "Network" w narzędziach deweloperskich (DevTools) widać poprawne żądanie formularza z użyciem metody GET, które zawiera wszystkie cztery parametry.
