<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdb6c47bb38b6cd62af8ff4a74da225b0
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'App\\Database' => __DIR__ . '/../..' . '/app/Database.php',
        'App\\Process' => __DIR__ . '/../..' . '/app/Process.php',
        'App\\Worker' => __DIR__ . '/../..' . '/app/Worker.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdb6c47bb38b6cd62af8ff4a74da225b0::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdb6c47bb38b6cd62af8ff4a74da225b0::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitdb6c47bb38b6cd62af8ff4a74da225b0::$classMap;

        }, null, ClassLoader::class);
    }
}