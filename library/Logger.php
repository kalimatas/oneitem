<?php

class Json extends \Phalcon\Logger\Formatter\Json
{
    public function format($message, $type, $ts)
    {
        return json_encode(array('ts' => $ts, 'dt' => date('Y-m-d H:i:s', $ts), 'lvl' => $this->getTypeString($type), 'msg' => $message)) . PHP_EOL;
    }
}

class Logger
{
    protected static $logger = array();

    public static function get($type = LOGUS)
    {
        $di = \Phalcon\DI::getDefault();

        if (!isset(self::$logger[$type])) {
            $logger = new \Phalcon\Logger\Multiple();
            $formatter = new Json();
            $logger->push(new \Phalcon\Logger\Adapter\File($di->get('config')->logs->$type));

            $logger->setFormatter($formatter);
            self::$logger[$type] = $logger;
        }

        return self::$logger[$type];
    }
}