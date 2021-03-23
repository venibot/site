<?php


namespace api;


class ErrorHandler {

    public function __construct() {
        if (DEBUG) {
            error_reporting(-1);
        } else {
            error_reporting(0);
        }
        set_exception_handler([$this, 'handleException']);
    }

    public function handleException($exception) {
        $code = $exception->getCode();
        if ($code != 404 && $code != 403 && $code != 401 && $code != 405) {
            $this->logException($exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getCode());
        }
        $this->displayException($exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getCode());
    }

    private function logException($message, $file, $line, $code) {
        error_log("[" . date('H:i:s d.m.Y') . "] - " . $message . ". Ошибка возникла в файле " . $file . " на строке " . $line
            . ". Отправленный HTTP код - " . $code . ".\n\n", 3, LOG_FILE);
    }

    private function displayException($message, $file, $line, $code) {
        header('Content-type: application/json; charset=utf-8', true, $code);
        if (DEBUG) {
            echo $this->jsonException($message, $code, $file, $line);
        } else {
            echo $this->jsonException($message, $code);
        }
        die;
    }

    private function jsonException($message, $code, $file = '', $line = '') {
        if ($file != '' && $line != '') {
            $json = ['error' => ['message' => $message, 'file' => $file, 'line' => $line], 'code' => $code];
        } else {
            $json = ['error' => ['message' => $message], 'code' => $code];
        }
        return json_encode($json);
    }

}