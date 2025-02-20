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

/**
 * An immutable object representing a color expressed in a precise and supported color space.
 *
 * It can be converted to another supported color space using one of the to...() methods.
 * Variant instances can be created with the change() method.
 *
 * This class is abstract so it can not be instanciated directly.
 * It is inherited by all classes in the Atomicptr\Color\Colors namespace.
 */
abstract class Color
{
    /* #region Magic Methods */

    /**
     * Returns the color as a CSS string (examples: '#ff0000', 'rgb(100% 0% 0% / 100%)'...).
     * This method is a shortcut to calling the stringify() method with its default parameters.
     *
     * @return string
     */
    public function __toString(

    ): string {
        return $this->stringify();
    }

    /* #endregion */

    /* #region Public Static Methods */

    /**
     * Returns the ColorSpace instance corresponding to the current color.
     *
     * @return ColorSpace
     */
    public static function space(

    ): ColorSpace {
        return ColorSpace::from(static::class);
    }

    /* #endregion */

    /* #region Public Methods */

    /**
     * Returns an array containing all coordinates of the current color.
     *
     * @return array
     */
    public function coordinates(

    ): array {
        return \array_values(\get_object_vars($this));
    }

    /**
     * Returns the color as a CSS string (examples: '#ff0000', 'rgb(100% 0% 0% / 100%)'...)
     * Each implementation of this method may add its own parameters, depending on the corresponding color space.
     *
     * @return string
     */
    public function stringify(

    ): string {
        return \implode(', ', $this->coordinates());
    }

    /**
     * Returns a new ColorInterface instance corresponding to the current color converted into the $to color space.
     *
     * @param  ColorSpace|\Stringable|string|null $to       The desired output color space (can be an instance of the ColorSpace enum or a stringable alias)
     * @param  ColorInterface|null                $fallback A ColorInterface instance used as a fallback in case of failure
     * @param  boolean|null                       $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return ColorInterface                               The converted color object
     */
    public function to(
        ColorSpace|\Stringable|string|null $to = null,
        ColorInterface|null $fallback = null,
        bool|null $throw = null,
    ): ColorInterface {
        return ColorFactory::new(
            value    : $this->coordinates(),
            to       : $to,
            from     : $this::space(),
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Css instance corresponding to the current color converted into the Css color space.
     *
     * @param  Css|null     $fallback A colors\Css instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Css                    The converted color object
     */
    public function toCss(
        Css|null $fallback = null,
        bool|null $throw = null,
    ): Css {
        return $this->to(
            to       : ColorSpace::Css,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\HexRgb instance corresponding to the current color converted into the HexRgb color space.
     *
     * @param  HexRgb|null  $fallback A colors\HexRgb instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return HexRgb                 The converted color object
     */
    public function toHexRgb(
        HexRgb|null $fallback = null,
        bool|null $throw = null,
    ): HexRgb {
        return $this->to(
            to       : ColorSpace::HexRgb,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Hsl instance corresponding to the current color converted into the Hsl color space.
     *
     * @param  Hsl|null     $fallback A colors\Hsl instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Hsl                    The converted color object
     */
    public function toHsl(
        Hsl|null $fallback = null,
        bool|null $throw = null,
    ): Hsl {
        return $this->to(
            to       : ColorSpace::Hsl,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Hsv instance corresponding to the current color converted into the Hsv color space.
     *
     * @param  Hsv|null     $fallback A colors\Hsv instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Hsv                    The converted color object
     */
    public function toHsv(
        Hsv|null $fallback = null,
        bool|null $throw = null,
    ): Hsv {
        return $this->to(
            to       : ColorSpace::Hsv,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Hwb instance corresponding to the current color converted into the Hwb color space.
     *
     * @param  Hwb|null     $fallback A colors\Hwb instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Hwb                    The converted color object
     */
    public function toHwb(
        Hwb|null $fallback = null,
        bool|null $throw = null,
    ): Hwb {
        return $this->to(
            to       : ColorSpace::Hwb,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Lab instance corresponding to the current color converted into the Lab color space.
     *
     * @param  Lab|null     $fallback A colors\Lab instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Lab                    The converted color object
     */
    public function toLab(
        Lab|null $fallback = null,
        bool|null $throw = null,
    ): Lab {
        return $this->to(
            to       : ColorSpace::Lab,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Lch instance corresponding to the current color converted into the Lch color space.
     *
     * @param  Lch|null     $fallback A colors\Lch instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Lch                    The converted color object
     */
    public function toLch(
        Lch|null $fallback = null,
        bool|null $throw = null,
    ): Lch {
        return $this->to(
            to       : ColorSpace::Lch,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\LinP3 instance corresponding to the current color converted into the LinP3 color space.
     *
     * @param  LinP3|null   $fallback A colors\LinP3 instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return LinP3                  The converted color object
     */
    public function toLinP3(
        LinP3|null $fallback = null,
        bool|null $throw = null,
    ): LinP3 {
        return $this->to(
            to       : ColorSpace::LinP3,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\LinProPhoto instance corresponding to the current color converted into the LinProPhoto color space.
     *
     * @param  LinProPhoto|null $fallback A colors\LinProPhoto instance used as a fallback in case of failure
     * @param  boolean|null     $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return LinProPhoto                The converted color object
     */
    public function toLinProPhoto(
        LinProPhoto|null $fallback = null,
        bool|null $throw = null,
    ): LinProPhoto {
        return $this->to(
            to       : ColorSpace::LinProPhoto,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\LinRgb instance corresponding to the current color converted into the LinRgb color space.
     *
     * @param  LinRgb|null  $fallback A colors\LinRgb instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return LinRgb                 The converted color object
     */
    public function toLinRgb(
        LinRgb|null $fallback = null,
        bool|null $throw = null,
    ): LinRgb {
        return $this->to(
            to       : ColorSpace::LinRgb,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\OkLab instance corresponding to the current color converted into the OkLab color space.
     *
     * @param  OkLab|null   $fallback A colors\OkLab instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return OkLab                  The converted color object
     */
    public function toOkLab(
        OkLab|null $fallback = null,
        bool|null $throw = null,
    ): OkLab {
        return $this->to(
            to       : ColorSpace::OkLab,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\OkLch instance corresponding to the current color converted into the OkLch color space.
     *
     * @param  OkLch|null   $fallback A colors\OkLch instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return OkLch                  The converted color object
     */
    public function toOkLch(
        OkLch|null $fallback = null,
        bool|null $throw = null,
    ): OkLch {
        return $this->to(
            to       : ColorSpace::OkLch,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\P3 instance corresponding to the current color converted into the P3 color space.
     *
     * @param  P3|null      $fallback A colors\P3 instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return P3                     The converted color object
     */
    public function toP3(
        P3|null $fallback = null,
        bool|null $throw = null,
    ): P3 {
        return $this->to(
            to       : ColorSpace::P3,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\ProPhoto instance corresponding to the current color converted into the ProPhoto color space.
     *
     * @param  ProPhoto|null $fallback A colors\ProPhoto instance used as a fallback in case of failure
     * @param  boolean|null  $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return ProPhoto                The converted color object
     */
    public function toProPhoto(
        ProPhoto|null $fallback = null,
        bool|null $throw = null,
    ): ProPhoto {
        return $this->to(
            to       : ColorSpace::ProPhoto,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\Rgb instance corresponding to the current color converted into the Rgb color space.
     *
     * @param  Rgb|null     $fallback A colors\Rgb instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return Rgb                    The converted color object
     */
    public function toRgb(
        Rgb|null $fallback = null,
        bool|null $throw = null,
    ): Rgb {
        return $this->to(
            to       : ColorSpace::Rgb,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\XyzD50 instance corresponding to the current color converted into the XyzD50 color space.
     *
     * @param  XyzD50|null  $fallback A colors\XyzD50 instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return XyzD50                 The converted color object
     */
    public function toXyzD50(
        XyzD50|null $fallback = null,
        bool|null $throw = null,
    ): XyzD50 {
        return $this->to(
            to       : ColorSpace::XyzD50,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /**
     * Returns a new colors\XyzD65 instance corresponding to the current color converted into the XyzD65 color space.
     *
     * @param  XyzD65|null  $fallback A colors\XyzD65 instance used as a fallback in case of failure
     * @param  boolean|null $throw    If false the method will not throw exceptions, $fallback will be returned instead
     *
     * @return XyzD65                 The converted color object
     */
    public function toXyzD65(
        XyzD65|null $fallback = null,
        bool|null $throw = null,
    ): XyzD65 {
        return $this->to(
            to       : ColorSpace::XyzD65,
            fallback : $fallback,
            throw    : $throw,
        );
    }

    /* #endregion */

}
