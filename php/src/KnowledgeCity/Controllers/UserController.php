<?php
namespace KnowledgeCity\Controllers;

use KnowledgeCity\Authorization;
use KnowledgeCity\Exceptions\Http401Exception;
use KnowledgeCity\Models\User;

class UserController extends Controller
{
    /**
     * @throws Http401Exception
     */
    public function indexAction() {
        if(Authorization::isAuthorized()) {
            $page = $_GET['page'];
            $path = $_REQUEST['path'];
            //        $perPage = $_GET['per_page'];
            echo json_encode(User::paginate($page, 5, $path), JSON_UNESCAPED_SLASHES);
        }else{
            throw new Http401Exception('Unauthorized');
        }
    }
}