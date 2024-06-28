<?php

declare(strict_types=1);

namespace App;


class SubstitutionEncodingAlgorithm implements EncodingAlgorithm
{
    private array $substitutions;

    /**
     * @param array<string> $substitutions
     */
    public function __construct(array $substitutions)
    {
        $this->substitutions = $substitutions;
    }

    /**
     * Encodes text by substituting character with another one provided in the pair.
     * For example pair "ab" defines all "a" chars will be replaced with "b" and all "b" chars will be replaced with "a"
     * Examples:
     *      substitutions = ["ab"], input = "aabbcc", output = "bbaacc"
     *      substitutions = ["ab", "cd"], input = "adam", output = "bcbm"
     */
    public function encode(string $text): string
    {
        /**
         * @todo: Implement it
         */

        $substitutionsLetters = '';

        for ($i = 0; $i < count($this->substitutions); $i++) {
            $substitution = $this->substitutions[$i];

            if (strlen($substitution) != '2') {
                throw new \InvalidArgumentException;
            }

            if ($substitution[1] === $substitution[0]) {
                throw new \InvalidArgumentException;
            }

            if (str_contains($substitutionsLetters, $substitution[0]) || str_contains($substitutionsLetters, $substitution[1])) {
                throw new \InvalidArgumentException;
            }
            $substitutionsLetters .= $substitution;

            for ($j = 0; $j < strlen($text); $j++) {
                $char = $text[$j];
                $isCapitalized = ctype_upper($char);
                if (stripos($char, $substitution[0]) !== false) {
                    $text[$j] = $isCapitalized ? strtoupper($substitution[1]) : $substitution[1];
                } else if (stripos($char, $substitution[1]) !== false) {
                    $text[$j] = $isCapitalized ? strtoupper($substitution[0]) : $substitution[0];
                }
            }

        }

        return $text;
    }
}
