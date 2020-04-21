CREATE DATABASE taskforce
  DEFAULT CHARACTER SET UTF8
  DEFAULT COLLATE UTF8_GENERAL_CI;

USE taskforce;


CREATE TABLE categories(
  id    INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(255) NOT NULL UNIQUE);

CREATE TABLE chat_message(
  id      INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT,
  message TEXT NOT NULL,
  chat_id INT);

CREATE TABLE chat(
 id INT AUTO_INCREMENT PRIMARY KEY,
 task_id INT);

CREATE TABLE cities(
  id    INT AUTO_INCREMENT PRIMARY KEY,
  title CHAR(255) NOT NULL UNIQUE);

CREATE TABLE reviews(
  id INT AUTO_INCREMENT PRIMARY KEY,
  task_id INT,
  message TEXT NOT NULL);

 CREATE TABLE favorites(
 id INT AUTO_INCREMENT PRIMARY KEY,
 customer_id INT NOT NULL,
 executor_id INT);



CREATE TABLE users(
 id INT AUTO_INCREMENT PRIMARY KEY,
 username CHAR(255) NOT NULL,
 email CHAR(255) NOT NULL UNIQUE,
 password CHAR(255) NOT NULL,
 city_id INT NOT NULL ,
 birthday DATE,
 user_about CHAR(255),
 skype CHAR(255),
 telegramm CHAR(255),
 phone_number CHAR(255),
 reg_dt TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
 avatar CHAR(255),
 categories_id INT,
 rating INT,
 orders_photo CHAR(255),
 last_online TIMESTAMP,
 notification_task INT DEFAULT '0',
 notification_actions INT DEFAULT '0',
 notification_new_review INT DEFAULT '0',
 profile_is_hidden INT DEFAULT '0',
 contacts_are_hidden INT DEFAULT '0');

 CREATE TABLE tasks(
 id INT AUTO_INCREMENT PRIMARY KEY,
 title CHAR(255) NOT NULL,
 task_description TEXT NOT NULL,
 category_id INT,
 file_attachment CHAR(255),
 city_id INT NOT NULL,
 location POINT NOT NULL,
 budget INT,
 deadline DATE,
 dt_add TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
 customer_id INT NOT NULL ,
 executor_id INT,
 task_status CHAR(255) DEFAULT 'new',
 is_done INT DEFAULT '0');
