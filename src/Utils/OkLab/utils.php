<?php

namespace Atomicptr\Color\Utils\OkLab;

use Atomicptr\Color\ColorSpace;
use Atomicptr\Color\Constant;
use Atomicptr\Color\Exceptions\MissingColorValue;
use Atomicptr\Color\Utils;

function clean(
    mixed $value,
    bool|null $throw = null,
): array {
    $values = utils\parseColorValue($value, 100);
    $lightness = $values['lightness'] ?? $values['l'] ?? $values[0] ?? null;
    $a = $values['a'] ?? $values[1] ?? null;
    $b = $values['b'] ?? $values[2] ?? null;
    $opacity = $values['opacity'] ?? $values['o'] ?? $values[3] ?? null;

    return match (true) {
        !$throw => null,
        ($lightness === null) => throw new MissingColorValue('lightness'),
        ($a === null) => throw new MissingColorValue('a'),
        ($b === null) => throw new MissingColorValue('b'),
        default => null,
    } ?? [
        utils\cleanCoordinate($lightness ?? 0, 0, 100),
        utils\cleanCoordinate($a ?? 0, null, null),
        utils\cleanCoordinate($b ?? 0, null, null),
        utils\cleanCoordinate($opacity ?? 100, 0, 100),
    ];
}

function from(
    mixed $value,
    ColorSpace|\Stringable|string|null $from = null,
    array|null $fallback = null,
    bool|null $throw = null,
): array {
    return utils\to(
        value    : $value,
        to       : ColorSpace::OkLab,
        from     : $from,
        fallback : $fallback,
        throw    : $throw,
    );
}

function stringify(
    float $lightness,
    float $a,
    float $b,
    float $opacity = 100,
    bool|null $legacy = null,
    bool|null $alpha = null,
    int|null $precision = null,
): string {
    $legacy ??= Constant::LEGACY->value();
    $precision ??= Constant::PRECISION->value();
    $s1 = ' ';
    $s2 = ' / ';
    $lUnit = '%';
    $abUnit = '';
    $aUnit = '%';
    $alpha ??= ($opacity !== (float) 100);

    if ($legacy) {
        $opacity /= 100;
        $aUnit = '';
        $s1 =
        $s2 = ',';
    }

    $value = "oklab("
        .\round($lightness, $precision)
        .$lUnit
        .$s1
        .\round($a, $precision)
        .$abUnit
        .$s1
        .\round($b, $precision)
        .$abUnit
    ;

    if (!$alpha) {
        return "$value)";
    }

    return $value
        .$s2
        .$opacity
        .$aUnit
        .')'
    ;
}

function verify(
    mixed $value,
): bool {
    return utils\isColorString($value, ColorSpace::OkLab);
}
