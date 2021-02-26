<?php

declare(strict_types=1);

namespace Pisac\Commit;

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
        $commit = Str::of($string);

        if ($commit->contains($this->scope->getSkipWords())) {
            return true;
        }

        return Str::of($string)->is($this->scope->getPattern());
    }
}
