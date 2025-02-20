<?php

namespace Atomicptr\Color;

use Atomicptr\Color\Colors\Css;
use Atomicptr\Color\Colors\HexRgb;
use Atomicptr\Color\Colors\Hsl;
use Atomicptr\Color\Colors\Hsv;
use Atomicptr\Color\Colors\Hwb;
use Atomicptr\Color\Colors\Lab;
use Atomicptr\Color\Colors\Lch;
use Atomicptr\Color\Colors\LinP3;
use Atomicptr\Color\Colors\LinProPhoto;
use Atomicptr\Color\Colors\LinRgb;
use Atomicptr\Color\Colors\OkLab;
use Atomicptr\Color\Colors\OkLch;
use Atomicptr\Color\Colors\P3;
use Atomicptr\Color\Colors\ProPhoto;
use Atomicptr\Color\Colors\Rgb;
use Atomicptr\Color\Colors\XyzD50;
use Atomicptr\Color\Colors\XyzD65;
use Atomicptr\Color\Exceptions\UnsupportedColorSpace;

/**
 * Represents a color space supported by Couleur.
 *
 * Can be accessed using aliases (all accepted alias are documented at https://github.com/matthieumastadenis/couleur-dev#-color-spaces).
 * Provides access to dedicated functions (clean(), from(), stringify(), verify()).
 */
enum ColorSpace: string
{
    /* #region Cases */

    case Css = Css::class;
    case HexRgb = HexRgb::class;
    case Hsl = Hsl::class;
    case Hsv = Hsv::class;
    case Hwb = Hwb::class;
    case Lab = Lab::class;
    case Lch = Lch::class;
    case LinP3 = LinP3::class;
    case LinProPhoto = LinProPhoto::class;
    case LinRgb = LinRgb::class;
    case OkLab = OkLab::class;
    case OkLch = OkLch::class;
    case P3 = P3::class;
    case ProPhoto = ProPhoto::class;
    case Rgb = Rgb::class;
    case XyzD50 = XyzD50::class;
    case XyzD65 = XyzD65::class;

    /* #endregion */

    /* #region Public Static Methods */

    /**
     * Returns an array containing all supported aliases and the corresponding ColorSpace instances.
     *
     * @return array
     */
    public static function allAliases(

    ): array {
        $aliases = [];

        foreach (static::cases() as $space) {
            $aliases[\strtolower($space->name)] = $space;

            foreach ($space->aliases(true) as $alias) {
                $aliases[(string) $alias] = $space;
            }
        }

        return $aliases;
    }

    /**
     * Returns the ColorSpace instance corresponding to the alias $name, if it exists.
     *
     * If $name does not match a supported alias, an UnsupportedColorSpace Exception will be thrown by default,
     * unless a $fallback is provided or $throw is set to false. In that case, the method will return $fallback.
     *
     * @param  \Stringable|string $name     Name or alias of the desired ColorSpace
     * @param  ColorSpace|null    $fallback Fallback returned if $name is not a supported alias
     * @param  boolean|null       $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return static|null                  The ColorSpace instance matching the $name alias, $fallback instead
     */
    public static function fromAlias(
        \Stringable|string $name,
        ColorSpace|null $fallback = null,
        bool|null $throw = null,
    ): static|null {
        $lcName = \strtolower((string) $name);
        $throw ??= !$fallback;

        foreach (static::allAliases($throw) as $alias => $space) {
            if ($lcName === \strtolower($alias)) {
                return $space;
            }
        }

        return ($throw || !$fallback)
            ? throw new UnsupportedColorSpace($name)
            : $fallback
        ;
    }

    /* #endregion */

    /* #region Public Methods */

    /**
     * Returns an array containing all supported aliases for the current ColorSpace.
     *
     * @return array
     */
    public function aliases(

    ): array {
        return ($this->value)::aliases();
    }

    /**
     * Returns the complete name of the clean() function dedicated to the current ColorSpace
     * (example: ColorSpace::Rgb->cleanCallback() returns "Atomicptr\Color\Utils\RGB\clean()')
     *
     * @return string
     */
    public function cleanCallback(

    ): string {
        return $this->callback('clean');
    }

    /**
     * Returns the complete name of the from() function dedicated to the current ColorSpace
     * (example: ColorSpace::Rgb->fromCallback() returns "Atomicptr\Color\Utils\RGB\from()')
     *
     * @return string
     */
    public function fromCallback(

    ): string {
        return $this->callback('from');
    }

    /**
     * Returns the complete name of the stringify() function dedicated to the current ColorSpace
     * (example: ColorSpace::Rgb->stringifyCallback() returns "Atomicptr\Color\Utils\RGB\stringify()')
     *
     * @return string
     */
    public function stringifyCallback(

    ): string {
        return $this->callback('stringify');
    }

    /**
     * Returns the complete name of the verifiy() function dedicated to the current ColorSpace
     * (example: ColorSpace::Rgb->verifyCallback() returns "Atomicptr\Color\Utils\RGB\verify()')
     *
     * @return string
     */
    public function verifyCallback(

    ): string {
        return $this->callback('verify');
    }

    /* #endregion */

    /* #region Protected Methods */

    /**
     * Returns the complete name of the desired function dedicated to the current ColorSpace
     *
     * @return string
     */
    protected function callback(
        \Stringable|string $name,
    ): string {
        return __NAMESPACE__
            .'\\utils\\'
            .\lcfirst($this->name)
            ."\\$name"
        ;
    }

    /* #endregion */

}
