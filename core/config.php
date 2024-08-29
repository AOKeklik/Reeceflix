<?php

















/* 

create database reeceflix;

create table user (
    id int auto_increment primary key not null,
    firstName varchar(25) not null,
    lastName varchar(25) not null,
    userName varchar(50) not null,
    email varchar(100) not null,
    password varchar(255) not null,
    isSubscribed tinyint(4) default 0 not null,
    created_at timestamp default current_timestamp not null
) engine=innodb default charset=utf8mb4;

*/