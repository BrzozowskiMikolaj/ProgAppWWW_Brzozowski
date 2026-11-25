function initThemeButton() {
    const themeButton = document.getElementById("theme-button");
    if (!themeButton) return;

    let savedTheme = localStorage.getItem('theme');
    if (savedTheme !== 'dark' && savedTheme !== 'light') {
        savedTheme = 'light';
    }

    document.documentElement.setAttribute('data-theme', savedTheme);
    if (savedTheme === 'dark') {
        themeButton.setAttribute('aria-pressed', 'true');
    } else {
        themeButton.setAttribute('aria-pressed', 'false');
    }

    themeButton.addEventListener('click', function () {
        const currentTheme = document.documentElement.getAttribute('data-theme');
        let newTheme;
        if (currentTheme === 'dark') {
            newTheme = 'light';
        } else {
            newTheme = 'dark';
        }
        document.documentElement.setAttribute('data-theme', newTheme);
        if (newTheme === 'dark') {
            themeButton.setAttribute('aria-pressed', 'true');
        } else {
            themeButton.setAttribute('aria-pressed', 'false');
        }
        localStorage.setItem('theme', newTheme);
    })
}

function initZegar() {
    const zegarWysw = document.getElementById('zegar-wyswietlacz');
    const zegarStart = document.getElementById('start-zegara');
    const zegarStop = document.getElementById('stop-zegara');
    if (!zegarWysw || !zegarStart || !zegarStop) return;
    let intervalId = null;
    const formatCzasu = new Intl.DateTimeFormat('pl-PL', {
        year: 'numeric',
        month: '2-digit',
        day: '2-digit',
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: false
    });

    function aktualizujZegar() {
        const teraz = new Date();
        zegarWysw.textContent = formatCzasu.format(teraz);
    }

    aktualizujZegar()

    zegarStart.addEventListener('click', function () {
        if (intervalId === null) {
            intervalId = setInterval(aktualizujZegar, 1000)
        }
    });
    zegarStop.addEventListener('click', function () {
        if (intervalId !== null) {
            clearInterval(intervalId);
            intervalId = null;
        }
    });


}

function initFiltrowanie() {
    const inputSzukaj = document.getElementById('szukaj-produktu');
    if (!inputSzukaj) return;
    const kartyProduktow = document.querySelectorAll('.karta');
    const licznik = document.getElementById('licznik-wynikow');
    const komunikatBrak = document.getElementById('brak-wynikow');

    licznik.textContent = kartyProduktow.length;

    inputSzukaj.addEventListener('input', function () {
        const tekst = inputSzukaj.value.trim().toLocaleLowerCase();
        let widoczneKarty = 0;
        kartyProduktow.forEach(function (karta) {
            const tekstKarty = karta.textContent.toLocaleLowerCase();
            if (tekstKarty.includes(tekst)) {
                karta.hidden = false;
                widoczneKarty = widoczneKarty + 1;
            } else {
                karta.hidden = true;
            }
        });
        licznik.textContent = widoczneKarty;
        if (widoczneKarty === 0) {
            komunikatBrak.hidden = false;
        } else {
            komunikatBrak.hidden = true;
        }
    });
}

function initFormularz() {
    const form = document.getElementById('formularz-kontaktowy');
    if (!form) return;
    const selectProdukt = document.getElementById('produkt');
    const inputIlosc = document.getElementById('ilosc');
    const obszarWartosc = document.getElementById('wartosc-obliczona');
    const textareaWiadomosc = document.getElementById('wiadomosc');
    const bladWiadomosc = document.getElementById('blad-wiadomosci');
    const podsumowanie = document.getElementById('podsumowanie-wysylki');
    const produkty = [
        {id: 'KluczMilwaukee', nazwa: 'Klucz Milwaukee M18 ONEFHIWF12-502X', cenaGrosze: 349999},
        {id: 'ADBL', nazwa: 'ADBL Beetle Juice Squeezer', cenaGrosze: 2399},
        {id: 'KING', nazwa: 'KING Drying Towel 1100GSM', cenaGrosze: 10599}
    ];

    const formatPLN = new Intl.NumberFormat('pl-PL', {style: 'currency', currency: 'PLN'});

    function obliczWartoscGrosze(cena, ilosc) {
        return cena * ilosc;
    }

    function aktualizujWycene() {
        podsumowanie.hidden = true;
        const wybraneId = selectProdukt.value;
        const produkt = produkty.find(p => p.id === wybraneId);
        const iloscWartosc = inputIlosc.value;
        const ilosc = Number(iloscWartosc);
        if (!produkt || !iloscWartosc || !Number.isInteger(ilosc) || ilosc < 1 || ilosc > 5) {
            obszarWartosc.textContent = "Wybierz produkt i podaj poprawną ilość (1-5 sztuk).";
            return;
        }
        const sumaGrosze = obliczWartoscGrosze(produkt.cenaGrosze, ilosc);
        obszarWartosc.textContent = "Aktualna wartość zapytania: " + formatPLN.format(sumaGrosze / 100);
    }

    selectProdukt.addEventListener('change', aktualizujWycene);
    inputIlosc.addEventListener('input', aktualizujWycene);
    textareaWiadomosc.addEventListener('input', function () {
        bladWiadomosc.hidden = true;
        podsumowanie.hidden = true;
    });
    form.addEventListener('submit', function (e) {
        e.preventDefault();
        const wiadomoscText = textareaWiadomosc.value.trim();
        if (wiadomoscText.length < 10) {
            bladWiadomosc.textContent = "Wiadomość musi mieć minimum 10 znaków (nie licząc skrajnych spacji).";
            bladWiadomosc.hidden = false;
            textareaWiadomosc.focus();
            return;
        }
        const wybraneId = selectProdukt.value;
        const produkt = produkty.find(p => p.id === wybraneId);
        const ilosc = Number(inputIlosc.value);
        const sumaGrosze = obliczWartoscGrosze(produkt.cenaGrosze, ilosc);
        document.getElementById('out-produkt').textContent = produkt.nazwa;
        document.getElementById('out-ilosc').textContent = ilosc;
        document.getElementById('out-wartosc').textContent = formatPLN.format(sumaGrosze / 100);
        document.getElementById('out-wiadomosc').textContent = wiadomoscText;

        podsumowanie.hidden = false;
    });
}

initFormularz();
initFiltrowanie();
initZegar();
initThemeButton();