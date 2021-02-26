<?php

declare(strict_types=1);

namespace Pisac\Commit;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class History
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
     * @return Collection
     */
    public function getMessages()
    {
        $path = $this->scope->getPath();
        $limit = $this->scope->getLimit();

        $output = shell_exec("cd $path ; git log -$limit --pretty=format:%s");

        return Str::of($output ?? '')->explode('\\n');
    }
}
