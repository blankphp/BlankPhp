create table students
(
  id       int primary key auto_increment,
  sid      varchar(20) not null,
  name     varchar(20) not null,
  sex      char(2)     not null,
  tel      varchar(11) not null,
  class_id int         not null
)engine=InnoDB;

create table class
(
  id         int primary key auto_increment,
  cid        varchar(20) not null,
  name       varchar(20) not null,
  teacher_id int         not null
)engine=InnoDB;

create table teacher
(
  id   int primary key auto_increment,
  tid  varchar(20) not null,
  name varchar(20) not null,
  sex  char(2)     not null
)engine=InnoDB;

create table course
(
  id        int primary key auto_increment,
  course_id varchar(20) not null,
  name      varchar(20) not null,
  credit    float(4)    not null
)engine=InnoDB;

create table teacher_course_class
(
  id         int primary key auto_increment,
  tcc_id     varchar(20) not null,
  course_id  int         not null,
  teacher_id int         not null,
  class_id   int         not null,
  credit     float(4)    not null
)engine=InnoDB;


create table teacher_course_class
(
  id         int primary key auto_increment,
  tcc_id     varchar(20) not null,
  course_id  int         not null,
  teacher_id int         not null,
  class_id   int         not null
)engine=InnoDB;

create table result
(
  id         int primary key auto_increment,
  student_id int      not null,
  tcc_id     int      not null,
  fraction   float(4) not null
)engine=InnoDB;

create table major
(
  id   int primary key auto_increment,
  mid  varchar(20) not null,
  name varchar(20) not null
)engine=InnoDB;

create table class_major
(
  id       int primary key auto_increment,
  class_id int not null,
  major_id int not null
)engine=InnoDB;


