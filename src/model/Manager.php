<?php
const CONFIG = ROOT . 'config' . DS;

require CONFIG . 'config.php';
class Manager {

    private static $db = false;

    protected function dbConnect() {
        global $dsn, $username, $password, $options;
        $db = self::$db;
        if ($db === false) {
            $db = new PDO($dsn, $username, $password, $options);
        }
        return $db;
    }

}
