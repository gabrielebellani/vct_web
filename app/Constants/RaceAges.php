<?php

namespace App\Constants;

class RaceAges
{
    public const GIOVANISSIMI = 'giovanissimi';
    public const GIOVANILE = 'giovanile';
    public const JUNIOR = 'junior';
    public const MASTER = 'master';

    public const AGES =  [
        self::GIOVANISSIMI,
        self::GIOVANILE,
        self::JUNIOR,
        self::MASTER
    ];

    public static function getLabeledAges(): array
    {
        return [
            self::GIOVANISSIMI => 'Giovanissimi',
            self::GIOVANILE => 'Esordienti - Allievi',
            self::JUNIOR => 'Junior',
            self::MASTER => 'Master'
        ];
    }

}