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

    public static function getLabel(array|string $value): string
    {
        if(is_array($value)) {
            return implode(', ', array_map([self::class, 'getLabel'], $value));
        }

        return self::getLabeledAges()[$value] ?? $value;
    }

    public static function getLabelFromString(string $values): string
    {
        return self::getLabel(explode(', ', $values));
    }

}