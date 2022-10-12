<?php

namespace KnowledgeCity\Models;

class User extends \KnowledgeCity\Model
{

    protected const TABLE = 'users';

    public string $username;
    public string $password;
//    public int $id;

}