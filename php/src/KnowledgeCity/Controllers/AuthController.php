<?php
namespace KnowledgeCity\Controllers;


use KnowledgeCity\Authorization;

class AuthController extends Controller
{
    public function loginAction() {
        if(!Authorization::isAuthorized()){
            $auth = new Authorization();
            $auth->authorize($_POST['username'],$_POST['password']);
        };
    }

    public function logoutAction() {
        if(Authorization::isAuthorized()){
            $auth = new Authorization();
            $auth->deleteAuth();
        }
    }
}