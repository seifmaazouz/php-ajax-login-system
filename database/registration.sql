CREATE DATABASE IF NOT EXISTS registration;
USE registration;

CREATE TABLE IF NOT EXISTS user ( 
    user_id int not null auto_increment, 
    email varchar(225) not null, 
    name varchar(225) not null, 
    password varchar(225) not null, 
    registration_date timestamp default current_timestamp, 
    PRIMARY KEY (user_id) 
);
