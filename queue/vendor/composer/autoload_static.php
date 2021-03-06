<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita3eb27e15b74fcc07ff4bf010cd7204a
{
    public static $prefixLengthsPsr4 = array (
        'Q' => 
        array (
            'Queue\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Queue\\' => 
        array (
            0 => __DIR__ . '/../..' . '/queue',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita3eb27e15b74fcc07ff4bf010cd7204a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita3eb27e15b74fcc07ff4bf010cd7204a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
