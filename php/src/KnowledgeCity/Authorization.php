<?php

namespace KnowledgeCity;

use KnowledgeCity\Models\User;

class Authorization
{
    public static function isAuthorized(): bool
    {
        return isset($_SESSION['user_id']);
    }
    public function authorize(string $userName, string $password){
        $user = User::find(['username'=>$userName]);
        if($user['username'] === $userName){
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
            }
        }
    }
    public function deleteAuth(){
        unset($_SESSION['user_id']);
    }
}