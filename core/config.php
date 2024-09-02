<?php

ob_start();
session_start();
date_default_timezone_set("Europe/Warsaw");

$host = "localhost";
$dbname = "reeceflix";
$username = "root";
$password = "12345678";

try {
    $dns = "mysql:host={$host};dbname={$dbname};charset=utf8";
    $pdo = new PDO($dns, $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $err) {
    die("DB connection error: ".$err->getMessage());
}


/* 

create database reeceflix;

create table user (
    id int auto_increment primary key not null,
    firstName varchar(255) not null,
    lastName varchar(255) not null,
    userName varchar(255) not null,
    email varchar(255) not null,
    password varchar(255) not null,
    isSubscribed tinyint(4) default 0 not null,
    created_at timestamp default current_timestamp not null
) engine=innodb default charset=utf8mb4;

create table category (
    id int primary key auto_increment not null,
    name varchar(255) not null
)engine=innodb default charset=utf8mb4;

create table entity (
    id int auto_increment primary key not null,
    categoryId int not null,
    name varchar(255) not null,
    thumbnail varchar(255) not null,
    preview varchar(255) not null,
    created_at timestamp default current_timestamp not null
)engine=innodb default charset=utf8mb4;

*/

