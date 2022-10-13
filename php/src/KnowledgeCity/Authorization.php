<?php

namespace KnowledgeCity;

use KnowledgeCity\Models\AuthToken;
use KnowledgeCity\Models\User;
use mysql_xdevapi\DatabaseObject;

class Authorization
{
    public static function isAuthorized(): bool
    {
        if(isset($_SESSION['user_id'])) {
            return true;
        }else {
            if (!empty($_COOKIE['remember_me'])) {
                list($selector, $authenticator) = explode(':', $_COOKIE['remember']);
                $params = ['selector'=>$selector];
                $authTokenRow = AuthToken::find($params);
                if (hash_equals($authTokenRow['token'], hash('sha256', base64_decode($authenticator)))) {
                    $_SESSION['user_id'] = $authTokenRow['user_id'];
                    return true;
                }
            }
        }
        return false;
    }
    public function authorize(string $userName, string $password, bool $rememberMe=false){
        $user = User::find(['username'=>$userName]);
        if($user['username'] === $userName){
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                if($rememberMe){
                    $selector = base64_encode(random_bytes(9));
                    $authenticator = random_bytes(33);

                    setcookie(
                        'remember_me',
                        $selector.':'.base64_encode($authenticator),
                        time() + 864000,
                        '/',
                    );
                    $authToken = new AuthToken();
                    $authToken->setSelector($selector);
                    $authToken->setToken(hash('sha256', $authenticator));
                    $authToken->setUserId($user['id']);
                    $authToken->setExpires(date('Y-m-d\TH:i:s', time() + 864000));
                    $authToken->insert();
                }
            }
        }else{
//            throw new
        }
    }
    public function deleteAuth(){
        unset($_SESSION['user_id']);
        unset($_COOKIE['remember_user']);
        setcookie('remember_user', null, -1, '/');
    }
}