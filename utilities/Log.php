<?php

namespace Utilities;

use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Env\Env;
use Exception;

class Log{

    private static $log;
    private static $logLevel = Logger::WARNING;

    public static function init()
    {
        self::$log = new Logger(Env::get('LOG_CHANNEL'));
        self::$log->pushHandler(new StreamHandler(realpath(Env::get('STORAGE_PATH'))), self::$logLevel);
    }

    public static function inBrowserConsole($level = 'DEBUG')
    {

        if(Env::get('DEBUG')){

            try{

                if($level == 'DEBUG'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
                }
                else if($level == 'INFO'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::INFO));
                }
                else if($level == 'NOTICE'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::NOTICE));
                }
                else if($level == 'WARNING'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::WARNING));
                }
                else if($level == 'ERROR'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::ERROR));
                }
                else if($level == 'CRITICAL'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::CRITICAL));
                }
                else if($level == 'ALERT'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::CRITICAL));
                }
                else if($level == 'EMERGENCY'){
                    self::$log->pushHandler(new BrowserConsoleHandler(Logger::CRITICAL));
                }
                else{
                    throw new Exception("$level is not a validate level");
                }
    
            }catch(Exception $e){
    
                return $e->getMessage();
    
            }

        }
        
    }

    public static function saveFromLevel($logLevel)
    {

        self::$logLevel = $logLevel;

    }

    public static function debug($message, $context = [])
    {
        self::init();
        self::$log->debug($message, $context);
    }

    public static function info($message, $context = [])
    {
        self::init();
        self::$log->info($message, $context);
    }

    public static function notice($message, $context = [])
    {
        self::init();
        self::$log->notice($message, $context);
    }

    public static function warning($message, $context = [])
    {
        self::init();
        self::$log->warning($message, $context);
    }

    public static function error($message, $context = [])
    {
        self::init();
        self::$log->error($message, $context);
    }

    public static function critical($message, $context = [])
    {
        self::init();
        self::$log->critical($message, $context);
    }

    public static function alert($message, $context = [])
    {
        self::init();
        self::$log->alert($message, $context);
    }

    public static function emergency($message, $context = [])
    {
        self::init();
        self::$log->emergency($message, $context);
    }
}