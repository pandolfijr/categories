<?php

namespace App\Helpers;

class ErrorApplication
{
    /**
     *
     * @var int
     */
    private $code;

    /**
     *
     * @var string
     */
    private $process;

    /**
     *
     * @var string
     */
    private $message;


    public function __construct($process, $message, $code)
    {
        $this->process = $process;
        $this->message = $message;
        $this->code = $code;
    }

    public function getProcess()
    {
        return $this->process;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function toArray()
    {
        return [
            'process' => $this->process,
            'message' => $this->message,
            'code' => $this->code
        ];
    }
}
