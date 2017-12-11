<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit086b5015126e34e4374318bd97302e9f
{
    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'pf\\img\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'pf\\img\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit086b5015126e34e4374318bd97302e9f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit086b5015126e34e4374318bd97302e9f::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
