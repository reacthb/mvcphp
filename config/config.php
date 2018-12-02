<?php

/**
 * Configuration for database connection
 *
 */
$host = "localhost";
$username = "root";
$tableUsers = "users";
$password = "2357@Mysql";
$dbname = "mvc_crud";
$dsn = "mysql:host=$host;dbname=$dbname;charset=utf8";
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);
