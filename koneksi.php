<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'db_labkes';
$con = new PDO("mysql:host=$hostname;dbname=$database", $username, $password);
