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

INSERT INTO `entity` (`id`, `name`, `thumbnail`, `preview`, `categoryId`) VALUES
('Friends', 'entities/thumbnails/friends.jpg', 'entities/previews/1.mp4', 3),
('The Simpsons', 'entities/thumbnails/thesimpsons.jpg', 'entities/previews/6.mp4', 19),
('Toy Story', 'entities/thumbnails/toystory.jpg', 'entities/previews/1.mp4', 12),
('Inbetweeners', 'entities/thumbnails/inbetw.jpg', 'entities/previews/2.mp4', 3),
('Suits', 'entities/thumbnails/Suits.jpg', 'entities/previews/3.mp4', 4),
('Captain Underpants', 'entities/thumbnails/cu.jpg', 'entities/previews/4.mp4', 12),
('Brooklyn Nine-Nine', 'entities/thumbnails/bnn.jpg', 'entities/previews/5.mp4', 3),
('That 70s Show', 'entities/thumbnails/tss.jpg', 'entities/previews/6.mp4', 3),
('Pokemon', 'entities/thumbnails/pok.jpg', 'entities/previews/2.mp4', 19),
('Spongebob Squarepants', 'entities/thumbnails/sbsp.jpg', 'entities/previews/3.mp4', 19),
('Futurama', 'entities/thumbnails/fut.jpg', 'entities/previews/1.mp4', 19),
('Johnny Bravo', 'entities/thumbnails/jb.jpg', 'entities/previews/4.mp4', 19),
('Teenage Mutant Ninja Turtles', 'entities/thumbnails/ninj.jpg', 'entities/previews/5.mp4', 19),
('Power Puff Girls', 'entities/thumbnails/ppg.jpg', 'entities/previews/6.mp4', 19),
('Teen Titans Go', 'entities/thumbnails/ttg.jpg', 'entities/previews/2.mp4', 19),
('Jurassic Park', 'entities/thumbnails/jp.jpg', 'entities/previews/3.mp4', 9),
('Grease', 'entities/thumbnails/grease.jpg', 'entities/previews/4.mp4', 16),
('Paddington Bear', 'entities/thumbnails/pb.jpg', 'entities/previews/5.mp4', 12),
('Santa Clause', 'entities/thumbnails/santa.jpg', 'entities/previews/1.mp4', 17),
('Monster Family', 'entities/thumbnails/monsterfamily.jpg', 'entities/previews/6.mp4', 12),
('Top Gun', 'entities/thumbnails/tg.jpg', 'entities/previews/2.mp4', 1),
('Home Alone', 'entities/thumbnails/ha.jpg', 'entities/previews/3.mp4', 17),
('The Grinch', 'entities/thumbnails/gr.jpg', 'entities/previews/4.mp4', 17),
('National Lampoon\'s Christmas Vacation', 'entities/thumbnails/la.jpg', 'entities/previews/5.mp4', 17),
('Elf', 'entities/thumbnails/elf.jpg', 'entities/previews/6.mp4', 17),
('Fred Claus', 'entities/thumbnails/fc.jpg', 'entities/previews/2.mp4', 17),
('Jaws', 'entities/thumbnails/jaws.jpg', 'entities/previews/3.mp4', 9),
('Live Die Repeat', 'entities/thumbnails/ldr.jpg', 'entities/previews/4.mp4', 9),
('Into the Storm', 'entities/thumbnails/its.jpg', 'entities/previews/1.mp4', 9),
('Mission Impossible', 'entities/thumbnails/mi.jpg', 'entities/previews/5.mp4', 1),
('Never Back Down', 'entities/thumbnails/nbd.jpg', 'entities/previews/6.mp4', 1),
('Mechanic', 'entities/thumbnails/mec.jpg', 'entities/previews/2.mp4', 1),
('Need for Speed', 'entities/thumbnails/nfs.jpg', 'entities/previews/3.mp4', 1),
('Gravity', 'entities/thumbnails/gra.jpg', 'entities/previews/4.mp4', 7),
('Step Brothers', 'entities/thumbnails/sb.jpg', 'entities/previews/5.mp4', 3),
('Game of Thrones', 'entities/thumbnails/got.jpg', 'entities/previews/1.mp4', 4),
('Dark Money', 'entities/thumbnails/dm.jpg', 'entities/previews/6.mp4', 4),
('Yellowstone', 'entities/thumbnails/yel.jpg', 'entities/previews/2.mp4', 4),
('Manifest', 'entities/thumbnails/man.jpg', 'entities/previews/3.mp4', 4),
('The Sound of Music', 'entities/thumbnails/som.jpg', 'entities/previews/4.mp4', 16),
('Hairspray', 'entities/thumbnails/hs.jpg', 'entities/previews/1.mp4', 16),
('Believe', 'entities/thumbnails/bel.jpg', 'entities/previews/5.mp4', 16),
('Chris Brown: Till I Die', 'entities/thumbnails/tid.jpg', 'entities/previews/6.mp4', 16),
('Men in Black', 'entities/thumbnails/mib.jpg', 'entities/previews/2.mp4', 7),
('Interstellar', 'entities/thumbnails/int.jpg', 'entities/previews/3.mp4', 7),
('Transformers', 'entities/thumbnails/tra.jpg', 'entities/previews/1.mp4', 7),
('Cloudy with a Chance of Meatballs', 'entities/thumbnails/cwc.jpg', 'entities/previews/4.mp4', 12),
('District 9', 'entities/thumbnails/d9.jpg', 'entities/previews/5.mp4', 9);

*/

