<?php namespace Lego;

use Lego\Helper\HtmlUtility;

class LegoAsset
{
    private static $styles = [];
    private static $scripts = [];

    private static function path($path)
    {
        return 'packages/wutongwan/lego/assets/' . trim($path, '/');
    }

    public static function css($path)
    {
        $path = self::path($path);
        if (!in_array($path, self::$styles)) {
            self::$styles [] = $path;
        }
    }

    public static function js($path)
    {
        $path = self::path($path);
        if (!in_array($path, self::$scripts)) {
            self::$scripts [] = $path;
        }
    }

    public static function basicStyles()
    {
        return [
            self::path('default/css/bootstrap.min.css'),
        ];
    }

    public static function basicScripts()
    {
        return [
            self::path('default/js/bootstrap.min.js'),
        ];
    }

    public static function renderScripts($scripts = [])
    {
        return join("\n", array_map(
            function ($script) {
                return HtmlUtility::html()->script($script);
            },
            $scripts
        ));
    }

    public static function renderStyles($styles = [])
    {
        return join("\n", array_map(
            function ($style) {
                return HtmlUtility::html()->style($style);
            },
            $styles
        ));
    }

    public static function scripts()
    {
        return self::renderScripts(array_merge(self::basicScripts(), self::$scripts));
    }

    public static function styles()
    {
        return self::renderStyles(array_merge(self::basicStyles(), self::$styles));
    }
}