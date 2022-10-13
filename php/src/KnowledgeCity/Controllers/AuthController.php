<?php
namespace KnowledgeCity\Controllers;


use KnowledgeCity\Authorization;

class AuthController extends Controller
{
    /**
     * @return void
     */
    public function loginAction() {
        try {
            $auth = new Authorization();
            $rememberMe = isset($_POST['remember_me']);
            $auth->authorize($_POST['username'], $_POST['password'], $rememberMe);
            echo json_encode(['status'=>'successfully login','code'=>200]);
        }catch (\Exception $e){
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

    public function logoutAction() {
        try {
            $auth = new Authorization();
            $auth->deleteAuth();
            echo json_encode(['status'=>'successfully logout','code'=>200]);
        }catch (\Exception $e){
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