<?php

declare(strict_types=1);

namespace Pisac\Commit;

use Composer\Autoload\ClassLoader;
use Illuminate\Support\Collection;

class Scope
{
    /**
     * @var Collection|null
     */
    private $settings;

    /**
     * @var string
     */
    private $path;

    /**
     * Scope constructor.
     */
    public function __construct()
    {
        //$reflection = new \ReflectionClass(ClassLoader::class);
        //$this->path = dirname($reflection->getFileName(), 3);

        $this->path = getcwd();

        $this->init();
    }

    /**
     * @throws \JsonException|\Throwable
     */
    public function init(): self
    {
        $file = $this->path . '/pisac.json';

        throw_unless(file_exists($file), "The configuration file was not found at the specified path: '$file'");

        $settings = json_decode(file_get_contents($file), true, 512, JSON_THROW_ON_ERROR);
        $this->settings = collect($settings);

        return $this;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     *
     * @throws \JsonException
     * @throws \Throwable
     *
     * @return Scope
     */
    public function setPath(string $path): self
    {
        $this->path = $path;

        return $this->init();
    }

    /**
     * @return string
     */
    public function getPattern(): string
    {
        return $this->settings->get('pattern', '\w+');
    }

    /**
     * @return string
     */
    public function getErrorMessage(): string
    {
        return $this->settings->get('message', 'The commit format is invalid.');
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->settings->get('limit', 1);
    }

    /**
     * @return array|null
     */
    public function getSkipWords(): ?array
    {
        return $this->settings->get('skip');
    }
}
