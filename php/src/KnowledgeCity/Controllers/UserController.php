<?php
namespace KnowledgeCity\Controllers;

use KnowledgeCity\Models\User;

class UserController extends Controller
{
    public function indexAction() {
        echo json_encode(User::paginate(),JSON_PRETTY_PRINT);
    }
}