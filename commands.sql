create database campaign;

use campaign;

grant all on campaign. * to testuser@localhost identified by '9999';

create table users(
  id int primary key auto_increment,
  name varchar(32),
  email varchar(32),
  postal1 char(3),
  postal2 char(4),
  address varchar(100),
  agree char (2),
  password int(7)
);

create table error_time(
  id int(42),
  created_at varchar(32));