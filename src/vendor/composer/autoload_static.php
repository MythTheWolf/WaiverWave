<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit68d6278c5cb0f0986e2ec9c96a5ecaa7
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit68d6278c5cb0f0986e2ec9c96a5ecaa7::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit68d6278c5cb0f0986e2ec9c96a5ecaa7::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
