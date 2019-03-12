# //创建表
create table user1(
                     id int primary key ,
                     name varchar(20) not null ,
                     password varchar(256) null  default '21321',
                     sex char(2)
);