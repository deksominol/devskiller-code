<?php

declare(strict_types=1);

namespace App;


class OffsetEncodingAlgorithm implements EncodingAlgorithm
{
    /**
     * Lookup string
     */
    public const CHARACTERS = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    private int $offset;

    public function __construct(int $offset = 13)
    {
        if ($offset < 0) {
            throw new \InvalidArgumentException;
        }

        $this->offset = $offset;
    }

    /**
     * Encodes text by shifting each character (existing in the lookup string) by an offset (provided in the constructor)
     * Examples:
     *      offset = 1, input = "a", output = "b"
     *      offset = 2, input = "z", output = "B"
     *      offset = 1, input = "Z", output = "a"
     */
    public function encode(string $text): string
    {
        /**
         * @todo: Implement it
         */


        $encodedString = '';
        $stringLength = strlen($text);
        $charactersLength = strlen(self::CHARACTERS);
        for ($i = 0; $i < $stringLength; $i++) {
            $char = $text[$i];
            $pos = strpos(self::CHARACTERS, $char);
            if ($pos !== false) {
                $newPos = ($pos + $this->offset) % $charactersLength;
                $encodedChar = self::CHARACTERS[$newPos];
            } else {
                $encodedChar = $char;
            }
            $encodedString .= $encodedChar;
        }
        return $encodedString;
    }
}
