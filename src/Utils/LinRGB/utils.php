<?php

namespace Atomicptr\Color\Utils\LinRGB;

use Atomicptr\Color\ColorSpace;
use Atomicptr\Color\Constant;
use Atomicptr\Color\Exceptions\MissingColorValue;
use Atomicptr\Color\Utils;

function clean(
    mixed $value,
    bool|null $throw = null,
): array {
    $values = utils\parseColorValue($value, 1);
    $red = $values['red'] ?? $values['r'] ?? $values[0] ?? null;
    $green = $values['green'] ?? $values['g'] ?? $values[1] ?? null;
    $blue = $values['blue'] ?? $values['b'] ?? $values[2] ?? null;
    $opacity = $values['opacity'] ?? $values['o'] ?? $values[3] ?? null;

    return match (true) {
        !$throw => null,
        ($red === null) => throw new MissingColorValue('red'),
        ($green === null) => throw new MissingColorValue('green'),
        ($blue === null) => throw new MissingColorValue('blue'),
        default => null,
    } ?? [
        utils\cleanCoordinate($red ?? 0, 0, 1),
        utils\cleanCoordinate($green ?? 0, 0, 1),
        utils\cleanCoordinate($blue ?? 0, 0, 1),
        utils\cleanCoordinate($opacity ?? 1, 0, 1),
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
        to       : ColorSpace::LinRgb,
        from     : $from,
        fallback : $fallback,
        throw    : $throw,
    );
}

function stringify(
    float $red,
    float $green,
    float $blue,
    float $opacity = 1,
    bool|null $alpha = null,
    int|null $precision = null,
): string {
    $legacy ??= Constant::LEGACY->value();
    $precision ??= Constant::PRECISION->value();
    $alpha ??= ($opacity !== (float) 1);

    $value = "color(srgb-linear "
        .\round($red, $precision)
        .' '
        .\round($green, $precision)
        .' '
        .\round($blue, $precision)
    ;

    if (!$alpha) {
        return "$value)";
    }

    return $value
        .' / '
        .$opacity * 100
        .'%)'
    ;
}

function verify(
    mixed $value,
): bool {
    return utils\isColorString($value, ColorSpace::LinRgb);
}
