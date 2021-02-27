<?php

declare(strict_types=1);

namespace Pisac\Commit;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Validator
{
    /**
     * @var Scope
     */
    protected $scope;

    /**
     * Validator constructor.
     *
     * @param Scope $scope
     */
    public function __construct(Scope $scope)
    {
        $this->scope = $scope;
    }

    /**
     * @param string $string
     *
     * @return bool
     */
    public function check(string $string): bool
    {
        if (Str::contains($string, $this->scope->getSkipWords())) {
            return true;
        }

        preg_match_all('/' . $this->scope->getPattern() . '/um', $string, $matches);

        return Arr::first($matches[0] ?? []) === $string;
    }
}
