<?php

namespace KnowledgeCity\Controllers;

use KnowledgeCity\Models\Student;
use KnowledgeCity\Models\User;

class SeedController extends Controller
{
    public static array $testUsers = [
        "admin" => "123123",
        "John" => "testPassword",
        "Jack" => "testPassword",
        "Liza" => "testPassword",
        "Bob" => "testPassword",
        "Nick" => "testPassword",
        "Den" => "testPassword",
        "Robert" => "testPassword",
        "Al" => "testPassword",
        "Aaron" => "testPassword",
        "Bolt" => "testPassword",
        "Robertff" => "testPassword",
        "Sergey" => "testPassword",
        "Nikita" => "testPassword",
        "Kate" => "testPassword",
        "Fedor" => "testPassword",
        "Alex" => "testPassword",
        "Svetlana" => "testPassword",
        "Alice" => "12345678"
    ];


    public static array $testStudents = [
        "admin" => "123123",
        "John" => "testPassword",
        "Jack" => "testPassword",
        "Liza" => "testPassword",
        "Bob" => "testPassword",
        "Nick" => "testPassword",
        "Den" => "testPassword",
        "Robert" => "testPassword",
        "Al" => "testPassword",
        "Aaron" => "testPassword",
        "Bolt" => "testPassword",
        "Robertff" => "testPassword",
        "Sergey" => "testPassword",
        "Nikita" => "testPassword",
        "Kate" => "testPassword",
        "Fedor" => "testPassword",
        "Alex" => "testPassword",
        "Svetlana" => "testPassword",
        "Alice" => "12345678"
    ];


    public static function indexAction() {
        $user = new User();
        foreach (self::$testUsers as $name=>$pass) {
            $user->setUsername($name);
            $user->setPassword(password_hash($pass,PASSWORD_DEFAULT));
            $user->insert();
        }
        $student = new Student();
        foreach (self::$testStudents as $name=>$pass) {
            $student->setUsername($name);
            $student->setName($name);
            $student->setLastName($name.'ovich');
            $student->insert();
        }
        echo json_encode(['result'=>'ok']);
    }
}