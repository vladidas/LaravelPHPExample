<?php

namespace Framework\Http\Middleware;

/**
 * Class LocaleMiddleware
 * @package Framework\Http\Middleware
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class LocaleMiddleware
{
    /**
     * @var string|null
     */
    static $prefix;

    /**
     * @return string|null
     */
    public static function getPrefix(): ?string
    {
        $segment = request()->segment(1);
        self::$prefix = $segment;

        if (!in_array($segment, config('app.locales'))) {
            $segment = config('app.locale');
            self::$prefix = null;
        }

        app()->setLocale($segment);

        return self::$prefix;
    }

    /**
     * @param string $locale
     * @return string
     */
    static function getUrlWithLocale(string $locale): string
    {
        return '/' . $locale . '/' . ltrim(request()->path(), '/' . self::$prefix);
    }
}
