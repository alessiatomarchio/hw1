CREATE DATABASE hw1;

USE hw1;

CREATE TABLE users (
   id INTEGER AUTO_INCREMENT PRIMARY KEY,
   name VARCHAR(255) NOT NULL,
   surname VARCHAR(255) NOT NULL,
   email VARCHAR(255) NOT NULL UNIQUE,
   username VARCHAR(255) NOT NULL UNIQUE,
   password VARCHAR(255) NOT NULL
) Engine = InnoDB;

CREATE TABLE admin (
password VARCHAR(255) PRIMARY KEY
) Engine = InnoDB;

insert into admin (password) values ("LNpdEqps2822"); 

create table ricette (
id INTEGER AUTO_INCREMENT PRIMARY KEY, 
titolo VARCHAR(255) NOT NULL, 
ingredienti VARCHAR(1000) NOT NULL, 
foto VARCHAR(255) NOT NULL,
procedimento VARCHAR(2500) NOT NULL
) Engine= InnoDB;

create table preferiti (
    userid INTEGER NOT NULL,
    ricetteid INTEGER NOT NULL,
    INDEX indx_user(userid),
    index indx_post(ricetteid),
    FOREIGN KEY(userid) REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY(ricetteid) REFERENCES ricette(id) ON UPDATE CASCADE ON DELETE CASCADE,
    PRIMARY KEY(userid, ricetteid)
)Engine = InnoDB;

select* from preferiti; 


