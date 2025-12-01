<?php

function getDb($dbname, $hostname = "localhost", $port = 3306, $username = "root", $password = ""): PDO
{
    try {
        $db = new PDO("mysql:host=$hostname;port=$port;dbname=$dbname", $username, $password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo 'Sikertelen kapcsolódás: ' . $e->getMessage();
        exit;
    }
}