<?php

namespace App\Constants;

class RaceClasses
{
    public const REGIONAL = 'regional';
    public const NATIONAL = 'national';
    public const INTERNATIONAL = 'international';
    public const LOVER = 'lover';

    public const CLASSES =  [
        self::REGIONAL,
        self::NATIONAL,
        self::INTERNATIONAL,
        self::LOVER
    ];

    public static function getLabeledClasses(): array
    {
        return [
            self::REGIONAL => 'Regionale',
            self::NATIONAL => 'Nazionale',
            self::INTERNATIONAL => 'Internazionale',
            self::LOVER => 'Amatoriale'
        ];
    }

}