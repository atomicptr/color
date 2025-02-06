<?php

namespace Atomicptr\Color\Utils\HexRGB;

use       Atomicptr\Color\CssColor;
use       Atomicptr\Color\Utils;
use       Atomicptr\Color\Utils\hsl;
use       Atomicptr\Color\Utils\hsv;
use       Atomicptr\Color\Utils\lab;
use       Atomicptr\Color\Utils\linP3;
use       Atomicptr\Color\Utils\linProPhoto;
use       Atomicptr\Color\Utils\linRgb;
use       Atomicptr\Color\Utils\okLab;
use       Atomicptr\Color\Utils\rgb;
use       Atomicptr\Color\Utils\xyzD50;
use       Atomicptr\Color\Utils\xyzD65;

function toCss(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :CssColor {
    return CssColor::fromHexRgb($red, $green, $blue);
}

function toHsl(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return rgb\toHsl(... toRgb($red, $green, $blue, $opacity));
}

function toHsv(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return hsl\toHsv(... toHsl($red, $green, $blue, $opacity));
}

function toHwb(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return hsv\toHwb(... toHsv($red, $green, $blue, $opacity));
}

function toLab(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return xyzD50\toLab(... toXyzD50($red, $green, $blue, $opacity));
}

function toLch(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return lab\toLch(... toLab($red, $green, $blue, $opacity));
}

function toLinP3(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return xyzD65\toLinP3(... toXyzD65($red, $green, $blue, $opacity));
}

function toLinProPhoto(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return xyzD50\toLinProPhoto(... toXyzD50($red, $green, $blue, $opacity));
}

function toLinRgb(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return rgb\toLinRgb(... toRgb($red, $green, $blue, $opacity));
}

function toOkLab(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return xyzD65\toOkLab(... toXyzD65($red, $green, $blue, $opacity));
}

function toOkLch(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return okLab\toOkLch(... toOkLab($red, $green, $blue, $opacity));
}

function toP3(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return linP3\toP3(... toLinP3($red, $green, $blue, $opacity));
}

function toProPhoto(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return linProPhoto\toProPhoto(... toLinProPhoto($red, $green, $blue, $opacity));
}

function toRgb(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return [
        utils\hexToDec($red),
        utils\hexToDec($green),
        utils\hexToDec($blue),
        utils\hexToDec($opacity),
    ];
}

function toXyzD50(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return xyzD65\toXyzD50(... toXyzD65($red, $green, $blue, $opacity));
}

function toXyzD65(
    string $red     = '00',
    string $green   = '00',
    string $blue    = '00',
    string $opacity = 'FF',
) :array {
    return linRgb\toXyzD65(... toLinRgb($red, $green, $blue, $opacity));
}