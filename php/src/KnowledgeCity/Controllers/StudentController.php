<?php
namespace KnowledgeCity\Controllers;

use KnowledgeCity\Authorization;
use KnowledgeCity\Exceptions\Http401Exception;
use KnowledgeCity\Models\Student;

class StudentController extends Controller
{
    /**
     * @return void
     */
    public function indexAction() {
        try {
            $page = $_GET['page'];
            $path = $_REQUEST['path'];
            //        $perPage = $_GET['per_page'];
            if(Authorization::isAuthorized()) {
                echo json_encode(Student::paginate($page,5,$path),JSON_UNESCAPED_SLASHES);
            }else{
                throw new Http401Exception('Unauthorized',401);
            }
        } catch (\Exception $e){
            echo json_encode(
                [
                    'error'=>[
                        'message'=>$e->getMessage(),
                        'code'=>$e->getCode(),
                    ]
                ]
            );
        }
    }
}