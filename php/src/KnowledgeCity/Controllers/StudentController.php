<?php
namespace KnowledgeCity\Controllers;

use KnowledgeCity\Models\Student;

class StudentController extends Controller
{
    public function indexAction() {
        $page = $_GET['page'];
        $path = $_REQUEST['path'];
//        $perPage = $_GET['per_page'];
        echo json_encode(Student::paginate($page,5,$path),JSON_UNESCAPED_SLASHES);
    }
}