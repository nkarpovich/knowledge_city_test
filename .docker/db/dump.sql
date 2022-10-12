create table `users`
(
    id       int  not null auto_increment,
    username text not null,
    password text not null,
    primary key (id)
);
insert into `users` (username, password)
values ("admin", "123123"),
       ("John", "testPassword"),
       ("Alice", "12345678");