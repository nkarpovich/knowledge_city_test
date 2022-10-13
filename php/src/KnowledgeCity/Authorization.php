<?php

namespace KnowledgeCity;

use KnowledgeCity\Exceptions\Http401Exception;
use KnowledgeCity\Exceptions\Http500Exception;
use KnowledgeCity\Exceptions\ValidationException;
use KnowledgeCity\Models\AuthToken;
use KnowledgeCity\Models\User;

class Authorization
{
    /**
     * Check if user is authorized
     * @return bool
     * @throws Exceptions\Http500Exception
     * @throws Http401Exception
     */
    public static function isAuthorized(): bool {

        if (isset($_SESSION['user_id'])) {
            return true;
        }
        else {
            if (!empty($_COOKIE['remember_me'])) {
                try {
                    list($selector, $authenticator) = explode(':', $_COOKIE['remember']);
                    $params = ['selector' => $selector];
                    $authTokenRow = AuthToken::find($params);
                    if(isset($authTokenRow[0]->token)) {
                        if (hash_equals($authTokenRow[0]->token, hash('sha256', base64_decode($authenticator)))) {
                            $_SESSION['user_id'] = $authTokenRow[0]->user_id;
                            return true;
                        }
                    }else{
                        throw new Http401Exception('Cookie is set incorrectly!', 401);
                    }
                }catch (Http401Exception $e){
                    throw $e;
                }catch (\Exception){
                    throw new Http500Exception('Internal server error',500);
                }

            }
        }
        return false;
    }

    /**
     *
     * @param string $userName
     * @param string $password
     * @param bool $rememberMe
     * @return void
     * @throws Http500Exception  if there is an error with DataBase query
     * @throws ValidationException|Http401Exception if login validation fails
     */
    public function authorize(string $userName, string $password, bool $rememberMe = false) {
        if(!Authorization::isAuthorized()) {
            $user = User::find(['username' => $userName]);
            if ($user[0]->username === $userName) {
                if (password_verify($password, $user[0]->password)) {
                    $_SESSION['user_id'] = $user[0]->id;
                    if ($rememberMe) {
                        $selector = base64_encode(random_bytes(9));
                        $authenticator = random_bytes(33);

                        setcookie(
                            'remember_me',
                            $selector . ':' . base64_encode($authenticator),
                            time() + 864000,
                            '/',
                        );
                        $authToken = new AuthToken();
                        $authToken->setSelector($selector);
                        $authToken->setToken(hash('sha256', $authenticator));
                        $authToken->setUserId($user[0]->id);
                        $authToken->setExpires(date('Y-m-d\TH:i:s', time() + 864000));
                        $authToken->insert();
                    }
                }
                else {
                    throw new ValidationException('Wrong password', 200);
                }
            }
            else {
                throw new ValidationException('Wrong user name', 200);
            }
        }else{
            throw new ValidationException('You are already authorized', 200);
        }
    }

    /**
     * Logout
     * @return void
     * @throws ValidationException|Http500Exception
     * @throws Http401Exception
     */
    public function deleteAuth() {
        if(self::isAuthorized()) {
            $authToken = AuthToken::find(['user_id'=>$_SESSION['user_id']]);
            AuthToken::delete($authToken[0]->id);
            unset($_SESSION['user_id']);
            unset($_COOKIE['remember_user']);
            setcookie('remember_user', null, -1, '/');
        }else{
            throw new ValidationException('You are not authorized',200);
        }
    }
}