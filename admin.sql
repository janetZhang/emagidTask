-- phpMyAdmin SQL Dump
-- version 3.3.9
--
-- Host: localhost
-- Server version: 5.5.8
-- PHP Version: 5.3.5
Drop database  IF EXISTS emagid_task ;
Create Database emagid_task;
USE `emagid_task`;

 Create table Categories ( 
 categoryId int not null AUTO_INCREMENT  Primary Key, 
 categoryName varchar(20) not null
 /*other properties*/
);

Create table Products ( 
 productId int not null AUTO_INCREMENT Primary Key , 
 productName varchar(30) not null,  
 description varchar(500), 
 /* picture mediumblob,*/
 /*createTime timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,*/
 /*discount float(3,2) ,*/
 /*repository int not null default 0*/
 price float (12,3) not null,
 catgId int not null,
 foreign key (catgId) references Categories(categoryId) 
 );
 
 
 USE `emagid_task`;
CREATE TABLE ae_gallery ( 
  id int(11) NOT NULL AUTO_INCREMENT primary key,
  title varchar(64)  NOT NULL,
  ext varchar(8)  NOT NULL,
  image_time timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  data mediumblob NOT NULL
);
