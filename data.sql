use BLOG;
create DATABASE blogo;  
use blogo;

create Table userdata(
    id INT AUTO_INCREMENT,
    Fullname VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    PRIMARY KEY(id)
);
select * from userdata;

use blogo;
create table post (
    id int auto_increment primary key,
    user_id int not null,
    title varchar(255) not null,
    content largetext not null,
    banner varchar(255) not null,
    views int default 0,
    created_at datetime default now(),
    updated_at datetime default now()
);




