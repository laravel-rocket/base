<?php
namespace App\Exceptions\Api;

use Exception;

class APIErrorException extends Exception
{
    /** @var string */
    protected $userMessage = '';

    protected $errorName   = '';

    protected $extraData   = [];

    protected $config      = [];

    /**
     * APIErrorException constructor.
     *
     * @param string $error
     * @param string $message
     * @param array  $extraData
     */
    public function __construct($error, $message, $extraData = [])
    {
        $this->errorName   = $error;
        $this->userMessage = $message;
        $this->extraData   = $extraData;
        $this->config      = $this->errorConfig();
        parent::__construct($message, $this->config['code'], null);
    }
}
