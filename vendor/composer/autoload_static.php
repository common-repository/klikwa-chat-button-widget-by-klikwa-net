<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInita15084fc92439851ce8e740ba95af075
{
    public static $prefixLengthsPsr4 = array (
        'K' => 
        array (
            'KWAP_Inc\\' => 9,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'KWAP_Inc\\' => 
        array (
            0 => __DIR__ . '/../..' . '/inc',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInita15084fc92439851ce8e740ba95af075::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInita15084fc92439851ce8e740ba95af075::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInita15084fc92439851ce8e740ba95af075::$classMap;

        }, null, ClassLoader::class);
    }
}
