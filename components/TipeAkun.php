<?php


namespace app\components;


class TipeAkun
{
    const ROOT = 'ROOT';
    const MEDIS = 'MEDIS';
    const NONMEDIS = 'NONMEDIS';
    const APLIKASI = 'APLIKASI';
    const Eksternal = 'Eksternal';

    public $items = [
        [
            'id' => self::MEDIS,
            'text' => 'Medis',
            'icon' => 'fa fa-user text-aqua',
            'keywords' => ['dokter', 'perawat', 'laboran'],
        ],
        [
            'id' => self::NONMEDIS,
            'text' => 'Non Medis',
            'icon' => 'fa fa-user text-green',
            'keywords' => ['farmasi', 'kas', 'akuntansi', 'pegawai'],
        ],
        [
            'id' => self::Eksternal,
            'text' => 'Eksternal',
            'icon' => 'fa fa-user text-orange',
            'keywords' => ['eksternal', 'eks'],
        ],
        [
            'id' => self::ROOT,
            'text' => 'ROOT',
            'icon' => 'fa fa-application text-green',
            'keywords' => ['aplikasi', 'app'],
        ],
        [
            'id' => self::APLIKASI,
            'text' => 'APLIKASI',
            'icon' => 'fa fa-application text-green',
            'keywords' => ['aplikasi', 'app'],
        ],
    ];
}