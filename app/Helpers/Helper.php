<?php

function set_active($uri, $output = 'active')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

function set_show($uri, $output = 'show')
{
    if (is_array($uri)) {
        foreach ($uri as $u) {
            if (Route::is($u)) {
                return $output;
            }
        }
    } else {
        if (Route::is($uri)) {
            return $output;
        }
    }
}

function get_month()
{
    return [
        [
            "id" => 12,
            "name" => "Desember"
        ],
        [
            "id" => 1,
            "name" => "Januari"
        ],
        [
            "id" => 2,
            "name" => "Februari"
        ],
        [
            "id" => 3,
            "name" => "Maret"
        ],
        [
            "id" => 4,
            "name" => "April"
        ],
        [
            "id" => 5,
            "name" => "Mei"
        ],
        [
            "id" => 6,
            "name" => "Juni"
        ],
        [
            "id" => 7,
            "name" => "Juli"
        ],
        [
            "id" => 8,
            "name" => "Agustus"
        ],
        [
            "id" => 9,
            "name" => "September"
        ],
        [
            "id" => 10,
            "name" => "Oktober"
        ],
        [
            "id" => 11,
            "name" => "November"
        ],
    ];
}

function get_month_grafik()
{
    return [
        [
            "id" => 1,
            "name" => "Januari"
        ],
        [
            "id" => 2,
            "name" => "Februari"
        ],
        [
            "id" => 3,
            "name" => "Maret"
        ],
        [
            "id" => 4,
            "name" => "April"
        ],
        [
            "id" => 5,
            "name" => "Mei"
        ],
        [
            "id" => 6,
            "name" => "Juni"
        ],
        [
            "id" => 7,
            "name" => "Juli"
        ],
        [
            "id" => 8,
            "name" => "Agustus"
        ],
        [
            "id" => 9,
            "name" => "September"
        ],
        [
            "id" => 10,
            "name" => "Oktober"
        ],
        [
            "id" => 11,
            "name" => "November"
        ],
        [
            "id" => 12,
            "name" => "Desember"
        ]
    ];
}


function periode($year = 2028)
{
    return [
        "2020",
        "2021",
        "2022",
        "2023",
        "2024",
        "2025"
    ];
}

function penyebut($nilai)
{
    $nilai = abs($nilai);
    $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
    $temp = "";
    if ($nilai < 12) {
        $temp = " " . $huruf[$nilai];
    } else if ($nilai < 20) {
        $temp = penyebut($nilai - 10) . " belas";
    } else if ($nilai < 100) {
        $temp = penyebut($nilai / 10) . " puluh" . penyebut($nilai % 10);
    } else if ($nilai < 200) {
        $temp = " seratus" . penyebut($nilai - 100);
    } else if ($nilai < 1000) {
        $temp = penyebut($nilai / 100) . " ratus" . penyebut($nilai % 100);
    } else if ($nilai < 2000) {
        $temp = " seribu" . penyebut($nilai - 1000);
    } else if ($nilai < 1000000) {
        $temp = penyebut($nilai / 1000) . " ribu" . penyebut($nilai % 1000);
    } else if ($nilai < 1000000000) {
        $temp = penyebut($nilai / 1000000) . " juta" . penyebut($nilai % 1000000);
    } else if ($nilai < 1000000000000) {
        $temp = penyebut($nilai / 1000000000) . " milyar" . penyebut(fmod($nilai, 1000000000));
    } else if ($nilai < 1000000000000000) {
        $temp = penyebut($nilai / 1000000000000) . " trilyun" . penyebut(fmod($nilai, 1000000000000));
    }
    return $temp;
}

function rupiah($angka)
{
    $hasil_rupiah = "Rp " . number_format($angka, 2, ',', '.');
    return $hasil_rupiah;
}
