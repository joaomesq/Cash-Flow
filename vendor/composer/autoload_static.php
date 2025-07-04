<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit336bded63e9966e3b53c3110cb009bf6
{
    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'FluxoCaixa\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'FluxoCaixa\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit336bded63e9966e3b53c3110cb009bf6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit336bded63e9966e3b53c3110cb009bf6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit336bded63e9966e3b53c3110cb009bf6::$classMap;

        }, null, ClassLoader::class);
    }
}
