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
       ("Jack", "testPassword"),
       ("Liza", "testPassword"),
       ("Bob", "testPassword"),
       ("Nick", "testPassword"),
       ("Den", "testPassword"),
       ("Robert", "testPassword"),
       ("Al", "testPassword"),
       ("Aaron", "testPassword"),
       ("Bolt", "testPassword"),
       ("Robert", "testPassword"),
       ("Sergey", "testPassword"),
       ("Nikita", "testPassword"),
       ("Kate", "testPassword"),
       ("Fedor", "testPassword"),
       ("Alex", "testPassword"),
       ("Svetlana", "testPassword"),
       ("Alice", "12345678");