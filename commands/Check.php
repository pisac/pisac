<?php

use Illuminate\Console\Command;
use Pisac\Commit\History;
use Pisac\Commit\Scope;
use Pisac\Commit\Validator;

class Check extends Command
{
    /**
     * @var string
     */
    protected $signature = 'check {--path=}';

    /**
     * @var string
     */
    protected $description = 'This is a simple hello world';

    /**
     * @var Scope
     */
    protected $scope;

    /**
     * @var History
     */
    protected $history;

    /**
     * @var Validator
     */
    protected $validator;

    /**
     * Create a new console command instance.
     *
     * @param Scope     $scope
     * @param History   $history
     * @param Validator $validator
     */
    public function __construct(Scope $scope, History $history, Validator $validator)
    {
        parent::__construct();

        $this->scope = $scope;
        $this->history = $history;
        $this->validator = $validator;
    }

    /**
     * @return int
     * @throws JsonException
     * @throws Throwable
     */
    public function handle(): int
    {
        if ($this->option('path') !== null) {
            $this->scope->setPath($this->option('path'));
        }

        $invalids = $this->history
            ->getMessages()
            ->filter(function ($message) {
                return !$this->validator->check($message);
            });

        if ($invalids->isEmpty()) {
            $this->info('The commit is valid');
            return self::SUCCESS;
        }

        $invalids->each(function ($message) {
            $this->warn('Commit: ' . $message);
        });

        $this->warn($this->scope->getErrorMessage());

        return self::FAILURE;
    }
}
