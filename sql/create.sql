//建数据库
CREATE DATABASE AppServer;

//建表
CREATE TABLE as_account(
id varchar(255) NOT NULL,
pass varchar(255) NOT NULL
);
INSERT INTO as_account VALUES('hsw','111');