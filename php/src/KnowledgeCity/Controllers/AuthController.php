<?php
namespace KnowledgeCity\Controllers;


use KnowledgeCity\Authorization;

class AuthController extends Controller
{
    public function loginAction() {
        if(!Authorization::isAuthorized()){
            $auth = new Authorization();
            $rememberMe = isset($_POST['remember_me']);
            $auth->authorize($_POST['username'],$_POST['password'],$rememberMe);
        };
    }

    public function logoutAction() {
        if(Authorization::isAuthorized()){
            $auth = new Authorization();
            $auth->deleteAuth();
        }
    }
}