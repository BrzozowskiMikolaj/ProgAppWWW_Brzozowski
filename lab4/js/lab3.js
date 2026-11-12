$(document).ready(function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        $.fx.off = true;
    }
    let powiekszenie = false;
    $('#przycisk_1').on('click', function () {
        powiekszenie = !powiekszenie;
        $(this).attr('aria-pressed', powiekszenie.toString());
        let wymiaryA;
        if (powiekszenie === true) {
            wymiaryA = {width: '240px', height: '130px'};
        } else {
            wymiaryA = {width: '160px', height: '90px'};
        }
        $(this).stop(true, false).animate(wymiaryA, 300);
    })

    let najazd = false;
    let fokus = false;

    function animacjaB() {
        let wymiaryB;
        if (najazd === true || fokus === true) {
            wymiaryB = {width: '220px', height: '120px'};
        } else {
            wymiaryB = {width: '160px', height: '90px'};
        }
        $('#przycisk_2').stop(true, false).animate(wymiaryB, 300);
    }

    $('#przycisk_2').on('mouseenter', function () {
        najazd = true;
        animacjaB();
    });
    $('#przycisk_2').on('mouseleave', function () {
        najazd = false;
        animacjaB();
    });
    $('#przycisk_2').on('focus', function () {
        fokus = true;
        animacjaB();
    });
    $('#przycisk_2').on('blur', function () {
        fokus = false;
        animacjaB();
    });

    let kroki = 0;
    const szerokosc = 160;
    const wysokosc = 90;
    $('#przycisk_3').on('click', function () {
        if ($(this).is(':animated')) {
            return;
        }
        if (kroki >= 5) {
            return;
        }
        kroki++;
        $('#status_krokow').text('Liczba kroków: ' + kroki);
        let nowaSzerokosc = szerokosc + (kroki * 20);
        let nowaWysokosc = wysokosc + (kroki * 10);
        $(this).animate({width: nowaSzerokosc + 'px', height: nowaWysokosc + 'px'}, 300);
    })

    $('#przycisk_reset').on('click', function () {
        powiekszenie = false;
        $('#przycisk_1').attr('aria-pressed', 'false');
        $('#przycisk_1').stop(true).css({width: '160px', height: '90px'});
        kroki = 0;
        $('#status_krokow').text('Liczba kroków: ' + kroki);
        $('#przycisk_3').stop(true).css({width: '160px', height: '90px'});
    });
    $('#przycisk_sprawdz').on('click', function () {
        let $przycisk = $(this);
        let $wynik = $('#wynik_serwera');
        $przycisk.prop('disabled', true);
        $wynik.text('Ładowanie...');
        $.ajax({
            url: 'status.php', method: 'GET', dataType: 'text', timeout: 5000
        })
            .done(function (odpowiedz) {
                $wynik.text(odpowiedz);
            })
            .fail(function () {
                $wynik.text('Błąd 404! Nie udało się pobrać danych z serwera.');
            })
            .always(function () {
                $przycisk.prop('disabled', false);
            });
    });

})