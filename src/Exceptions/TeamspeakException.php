<?php
namespace Micky5991\laravel_ts3admin\Exceptions;

use Exception;
use par0noid\ts3admin\ts3admin;

class TeamspeakException extends Exception
{

    public function __construct(ts3admin $ts, Exception $previous = NULL)
    {
        $messages = $ts->getDebugLog();
        parent::__construct(end($messages), 0, $previous);
    }

}