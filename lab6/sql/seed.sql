USE moja_strona;

INSERT INTO page_list (alias, page_title, page_content, status) VALUES
('glowna', 'Katalog', '<h2>Strona główna</h2>
<p id="zegar-wyswietlacz"></p>
<button type="button" id="start-zegara">Start zegara</button>
<button type="button" id="stop-zegara">Stop zegara</button>
<section class="wyszukiwarka-produktow">
    <label for="szukaj-produktu">Szukaj produktu:</label>
    <input type="search" id="szukaj-produktu" placeholder="Wpisz nazwę...">
    <div aria-live="polite" id="obszar-komunikatow">
        <p>Liczba wyników: <span id="licznik-wynikow"></span></p>
        <p id="brak-wynikow" hidden>Brak produktów pasujących do wyszukiwania.</p>
    </div>
</section>
<div class="katalog">
    <article class="karta">
        <h3>Klucz Milwaukee M18 ONEFHIWF12-502X</h3>
        <img src="img/MILWAUKEE_M18_ONEFHIWF12-502X.jpg"
             alt="Czerwono-czarny akumulatorowy klucz udarowy Milwaukee M18 FUEL z podpiętą baterią 5.0 Ah i niebieskim symbolem łączności" width="800" height="800">
        <p>Wysokoobrotowy klucz udarowy M18 FUEL™ z technologią ONE-KEY™ zapewnia moment obrotowy 1356 Nm.</p>
        <p>3 499,99 PLN</p>
        <a href="index.php?idp=produkt">Zobacz Szczegóły</a>
    </article>
    <article class="karta">
        <h3>Produkt do usuwania owadów z samochodu</h3>
        <img src="img/ADBL_BEETLE_JUICE_SQUEEZER.jpg"
             alt="Czarna butelka ze spryskiwaczem płynu ADBL Beetle Juice Squeezer do usuwania owadów" width="1000" height="1060">
        <p>ADBL Beetle Juice Squeezer to szybko działający preparat do bezpiecznego usuwania uporczywych pozostałości po owadach, soków z drzew i ptasich odchodów z lakieru oraz elementów karoserii.</p>
        <p>23,99 PLN</p>
    </article>
    <article class="karta">
        <h3>KING Drying Towel 1100GSM - Ręcznik do osuszania samochodu</h3>
        <img src="img/king_towell_1100gsm.jpeg" alt="Zrolowany puszysty ręcznik z mikrofibry obok czarno-żółtego opakowania Work Stuff King Drying Towel" width="1600" height="1600">
        <p>KING Drying Towel 1100 GSM to gruby, niezwykle chłonny ręcznik mikrofibrowy o gramaturze 1100 g/m², stworzony do szybkiego i bezpiecznego osuszania lakieru samochodowego bez ryzyka powstawania zarysowań.</p>
        <p>105,99 PLN</p>
    </article>
</div>
<section class="sekcja-demo">
    <button type="button" class="przycisk-animowany" id="przycisk-1">Przycisk 1</button>
    <button type="button" class="przycisk-animowany" id="przycisk-2">Przycisk 2</button>
    <button type="button" class="przycisk-animowany" id="przycisk-3">Przycisk 3</button>
    <p id="status-krokow" role="status">Liczba kroków: 0</p>
    <button type="button" id="przycisk-reset">Resetuj A i C</button>
    <button type="button" id="przycisk-sprawdz">Sprawdź serwer</button>
    <p id="wynik-serwera" role="status">Oczekuję na sprawdzenie...</p>
</section>

', 1),
('produkt', 'Produkt', '<h2>Klucz Milwaukee M18 ONEFHIWF12-502X</h2>
<img src="img/MILWAUKEE_M18_ONEFHIWF12-502X.jpg" alt="Czerwono-czarny akumulatorowy klucz udarowy Milwaukee M18 FUEL z podpiętą baterią 5.0 Ah i niebieskim symbolem łączności" width="800" height="800">
<p><strong>3 499,99 PLN</strong></p>
<p>Wysokoobrotowy klucz udarowy <em>M18 FUEL™</em> z technologią ONE-KEY™ zapewnia moment obrotowy 1356 Nm.</p>
<h3>Główne cechy produktu:</h3>
<ul>
    <li>Uchwyt narzędzia: 1/2" kwadratowy (z pierścieniem zabezpieczającym)</li>
    <li>Typ akumulatora: Li-ion</li>
    <li>Ilość akumulatorów: 2</li>
    <li>Niezawodny, bezszczotkowy silnik POWERSTATE™ zapewniający dłuższą żywotność.</li>
    <li>4-stopniowy system DRIVE CONTROL™ pozwalający na precyzyjną kontrolę prędkości pracy.</li>
    <li>Wbudowany czujnik liczący uderzenia zwiększa powtarzalność wybranego momentu obrotowego.</li>
    <li>Technologia ONE-KEY™ do bezprzewodowego zarządzania i lokalizowania narzędzia.</li>
</ul>
<table>
    <caption>Specyfikacja techniczna Milwaukee M18 ONEFHIWF12-502X</caption>
    <thead>
    <tr>
        <th scope="col">Parametr</th>
        <th scope="col">Wartość</th>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td>Napięcie akumulatora</td>
        <td>18V</td>
    </tr>
    <tr>
        <td>Maks. moment obrotowy</td>
        <td>130/400/1356/1356 Nm</td>
    </tr>
    <tr>
        <td>Moment zrywający</td>
        <td>1898 Nm</td>
    </tr>
    <tr>
        <td>Częstotliwość udaru</td>
        <td>0-950/0-1750/0-2100/0-2100 ud./min</td>
    </tr>
    <tr>
        <td>Prędkość bez obciążenia:</td>
        <td>0-550/0-1400/0-1750/0-1750 obr/min</td>
    </tr>
    </tbody>
</table>
<p><a href="index.php?idp=kontakt">Zapytaj o produkt</a></p>', 1),
('kontakt', 'Kontakt', '<h2>Formularz zapytania</h2>
<p>Podgląd lokalny. Formularz nie wysyła wiadomości.</p>
<form id="formularz-kontaktowy">
    <label for="email"> Adres e-mail (wymagane): </label>
    <input id="email" type="email" name="email" required>
    <label for="produkt">Wybierz produkt (wymagane): </label>
    <select id="produkt" name="produkt" required>
        <option value="">Wybierz produkt</option>
        <option value="KluczMilwaukee">Klucz Milwaukee M18 ONEFHIWF12-502X</option>
        <option value="ADBL">ADBL Beetle Juice Squeezer</option>
        <option value="KING">KING Drying Towel 1100GSM</option>
    </select>
    <label for="ilosc">Liczba sztuk (od 1 do 5, wymagane):</label>
    <input id="ilosc" type="number" name="ilosc" required min="1" max="5" step="1">
    <p id="wartosc-obliczona"></p>
    <label for="wiadomosc">Treść wiadomości(10-500 znaków, wymagane):</label>
    <textarea id="wiadomosc" name="wiadomosc" required minlength="10" maxlength="500"></textarea>
    <p id="blad-wiadomosci" hidden></p>
    <button type="submit">Sprawdź zapytanie</button>
</form>

<section id="podsumowanie-wysylki" hidden>
    <h3>Podsumowanie zapytania:</h3>
    <p>Produkt: <span id="out-produkt"></span></p>
    <p>Ilość: <span id="out-ilosc"></span></p>
    <p>Wartość: <span id="out-wartosc"></span></p>
    <p>Wiadomość: <span id="out-wiadomosc"></span></p>
</section>', 1),
('filmy', 'Filmy', '<h2>Filmy</h2>
<p>Materiały wideo pokazujące działanie produktów na stornie</p>

<section class="lista-filmow" aria-label="Lista Filmów">
    <article class="film">
        <h3>Test Klucza Udarowego Milwaukee M18 FUEL</h3>
        <iframe  class="odtwarzacz-wideo" src="https://www.youtube.com/embed/VwakxSlRs90?autoplay=0" title="Test klucza udarowego Milwaukee M18 FUEL na YouTube" allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <p><a href="https://www.youtube.com/watch?v=VwakxSlRs90" target="_blank" rel="noopener noreferrer">Obejrzyj film na YouTube</a></p>
    </article>
    <article class="film">
        <h3>Jak bezpiecznie usuwać owady z lakieru – ADBL Beetle Juice Squeezer Tutorial
        </h3>
        <iframe
                class="odtwarzacz-wideo"
                src="https://www.youtube.com/embed/MTLNK_nvt8U?autoplay=0"
                title="ADBL Beetle Juice Squeezer Tutorial na YouTube"
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
        <p><a href="https://www.youtube.com/watch?v=MTLNK_nvt8U" target="_blank" rel="noopener noreferrer">Obejrzyj film na YouTube</a></p>
    </article>
    <article class="film">
        <h3>Osuszanie samochodu ręcznikiem z mikrofibry</h3>
        <iframe
                class="odtwarzacz-wideo"
                src="https://www.youtube.com/embed/1x5bovcqr3w?autoplay=0"
                title="Poradnik osuszania lakieru samochodowego ręcznikiem z mikrofibry w serwisie YouTube"
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen>
        </iframe>
        <p><a href="https://www.youtube.com/watch?v=1x5bovcqr3w" target="_blank" rel="noopener noreferrer">Obejrzyj film na YouTube</a></p>
    </article>
</section>', 1),
('szkic', 'Szkic promocji', '<h2>Szkic</h2>', 0);