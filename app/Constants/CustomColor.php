<?php

namespace App\Constants;

use Filament\Support\Colors\Color;
use Spatie\Color\Hex;
use Spatie\Color\Rgb;

class CustomColor extends Color
{
    public static function VanottiBlue(): array
    {

        return parent::generateShades(
            Hex::fromString('#2bb6a9')->toRgb()
        );
    }
}
