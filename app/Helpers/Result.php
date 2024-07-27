<?php

namespace App\Helpers;

class Result
{
    /**
     *
     * @var bool
     */
    private $success;

    /**
     *
     * @var mixed
     */
    private $data;

    /**
     *
     * @var ErrorApplication
     */
    private $error;

    public function __construct(bool $success, $data = null, ErrorApplication $error = null)
    {
        $this->success = $success;
        $this->data = $data;
        $this->error = $error;
    }

    public function isSuccess(): bool
    {
        return $this->success;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getError(): ?ErrorApplication
    {
        return $this->error;
    }

    public static function success($data = null): Result
    {
        return new Result(true, $data);
    }

    public static function error(ErrorApplication $error): Result
    {
        return new Result(false, null, $error);
    }
}
