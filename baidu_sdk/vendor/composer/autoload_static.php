<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit3b7394c492c9f24c29220b554955f430
{
    public static $prefixLengthsPsr4 = array (
        'm' => 
        array (
            'meolu\\AliyunOSS\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'meolu\\AliyunOSS\\' => 
        array (
            0 => __DIR__ . '/..' . '/meolu/yii2-oss',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit3b7394c492c9f24c29220b554955f430::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit3b7394c492c9f24c29220b554955f430::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
