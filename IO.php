<?php

class IO
{
    protected static $fontColor = [
        'black'        => '1;30;', 'dark_gray'    => '1;30;',
        'blue'         => '1;34;', 'light_blue'   => '1;34;',
        'green'        => '1;32;', 'light_green'  => '1;32;',
        'cyan'         => '1;36;', 'light_cyan'   => '1;36;',
        'red'          => '1;31;', 'light_red'    => '1;31;',
        'purple'       => '1;35;', 'light_purple' => '1;35;',
        'brown'        => '1;33;', 'yellow'       => '1;33;',
        'light_gray'   => '1;37;', 'white'        => '1;37;',
        'default'      => '1;39;',
    ];

    protected static $fontVariant = [
        'default'       => '0',
        'bold'          => '1',
        'dim'           => '2',
        'italic'        => '3',
        'underline'     => '4',
        'blinking'      => '5',
        'inverse'       => '7',
        'hidden'        => '8',
        'striketrough'  => '9'
    ];

    protected static $backgroundColor = [
        'default'      => '40m',
        'red'          => '41m',
        'green'        => '42m',
        'yellow'       => '43m',
        'blue'         => '44m',
        'magenta'      => '45m',
        'cyan'         => '46m',
        'light_gray'   => '47m',
    ];

    protected static $outputColorPrefix = "\e[";

    protected static $outputColorReset = "\e[0m";

    public static function question($question)
    {
        return readline($question);
    }

    public static function questionWithVariants($question, array $variants)
    {
        while (true) {
            $answer = readline($question);

            if ($answer === 'list') {
                echo "\e[42mYou can use that variants: " . implode(', ', $variants) . "\e[0m\n";
                continue;
            }

            if (in_array($answer, $variants)) {
                return $answer;
            }

            echo 'That variant is not support. You may to use "list" command.' . PHP_EOL;
        }
    }

    protected static function colorize(string $string, string $color = 'default', string $bg = 'default', bool $newline = true)
    {

        $color = self::applyColor($color);
        $bg = self::applyBackground($bg);
        $divider = $newline ? "\n" : "";

        printf('%s1;%s%s%s%s%s', self::$outputColorPrefix, $color, $bg, $string, self::$outputColorReset, $divider);
    }

    protected static function applyColor(string $color)
    {
        if (array_key_exists($color, self::$fontColor)) {
            return self::$fontColor[$color];
        }

        return self::$fontColor['default'];
    }

    protected static function applyBackground(string $bg)
    {
        if (array_key_exists($bg, self::$backgroundColor)) {
            return self::$backgroundColor[$bg];
        }

        return self::$backgroundColor['default'];
    }

    public static function outputContainer(string $string, int $length)
    {
        self::colorize('**************************', 'red', 'light_gray');
        // $stringLen = strlen($string);
        // $words = explode(' ', $string);
        // $wordsCount = count($words);
        // $stringLines = round($stringLen / $length, 0, PHP_ROUND_HALF_DOWN);
        // var_dump($stringLen, $words, $wordsCount, $stringLines);
    }
}


// colorize('some string what have some, big length for example ho ho hihi', 'blue', true, 'yellow');
// $licenseName = questionWithVariants('What license you will use: ', ['MIT', 'GNU']);
// $vendorName = question('Enter vendor name: ');
// $packageName = question('Enter package name: ');

// var_dump($vendorName, $packageName);




