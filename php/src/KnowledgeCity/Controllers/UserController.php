<?php
namespace KnowledgeCity\Controllers;

use KnowledgeCity\Authorization;
use KnowledgeCity\Exceptions\AuthorizationException;
use KnowledgeCity\Models\User;

class UserController extends Controller
{
    public function indexAction() {
        if(Authorization::isAuthorized()) {
            $page = $_GET['page'];
            $path = $_REQUEST['path'];
            //        $perPage = $_GET['per_page'];
            echo json_encode(User::paginate($page, 5, $path), JSON_UNESCAPED_SLASHES);
        }else{
            throw new AuthorizationException('Unauthorized user');
        }
    }
}