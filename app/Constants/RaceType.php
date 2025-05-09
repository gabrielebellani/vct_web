<?php

namespace App\Constants;

class RaceType
{
    public const MAIN_MTB = 'mtb';
    public const MAIN_ROAD = 'road';

    public const SUB_MTB_XCO = 'xco';
    public const SUB_MTB_XCC = 'xcc';
    public const SUB_MTB_XCE = 'xce';
    public const SUB_MTB_XCM = 'xcm';
    public const SUB_MTB_XCP = 'xcp';
    public const SUB_MTB_XCR = 'xcr';

    public const SUB_ROAD_LINE = 'line';
    public const SUB_ROAD_TT = 'tt';

    public const MAIN_TYPES =  [
        self::MAIN_MTB,
        self::MAIN_ROAD,
    ];

    public const SUB_MTB_TYPES = [
        self::SUB_MTB_XCO,
        self::SUB_MTB_XCC,
        self::SUB_MTB_XCE,
        self::SUB_MTB_XCM,
        self::SUB_MTB_XCP,
        self::SUB_MTB_XCR,
    ];

    public const SUB_ROAD_TYPES = [
        self::SUB_ROAD_LINE,
        self::SUB_ROAD_TT,
    ];

    public const SUB_TYPES = [
        ...self::SUB_MTB_TYPES,
        ...self::SUB_ROAD_TYPES,
    ];

    public static function getLabeledMainTypes(): array
    {
        return [
            self::MAIN_MTB => 'MTB',
            self::MAIN_ROAD => 'Strada',
        ];
    }

    public static function getLabeledSubTypes(): array
    {
        return [
            self::SUB_MTB_XCO => 'XCO',
            self::SUB_MTB_XCC => 'XCC',
            self::SUB_MTB_XCE => 'XCE',
            self::SUB_MTB_XCM => 'XCM',
            self::SUB_MTB_XCP => 'XCP',
            self::SUB_MTB_XCR => 'XCR',
            self::SUB_ROAD_LINE => 'In linea',
            self::SUB_ROAD_TT => 'Cronometro',
        ];
    }

    public static function getLabel(string $type): string
    {
        return self::getLabeledMainTypes()[$type] ?? self::getLabeledSubTypes()[$type];
    }

}