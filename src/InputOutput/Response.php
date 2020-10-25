<?php

namespace App\InputOutput;

class Response
{
    public const EXIT_CODE_OK = 0;
    public const EXIT_CODE_ERROR = 1;
    public const EXIT_CODE_MISSING_ARG = 2;
    public const EXIT_CODE_NOT_FOUND = 3;

    private bool $silent;
    private array $messages = [];
    private int $exitCode = self::EXIT_CODE_OK;

    public function __construct()
    {
        $this->silent = (bool)@$_ENV['TEST'];
    }

    public function say(string $message): self
    {
        $this->messages[] = $message;

        if (!$this->silent)
            echo "{$message}\n";

        return $this;
    }

    public function getMessages(): array
    {
        return $this->messages;
    }

    public function getExitCode(): int
    {
        return $this->exitCode;
    }

    public function setExitCode(int $exitCode): Response
    {
        $this->exitCode = $exitCode;
        return $this;
    }
}