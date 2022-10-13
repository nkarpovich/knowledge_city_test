<?php

namespace KnowledgeCity\Models;

class AuthToken extends Model
{
    protected const TABLE = 'auth_tokens';

    public string $selector;
    public string $token;
    public int $user_id;
    public string $expires;

    /**
     * @return string
     */
    public function getSelector(): string {
        return $this->selector;
    }

    /**
     * @param string $selector
     */
    public function setSelector(string $selector): void {
        $this->selector = $selector;
    }

    /**
     * @return string
     */
    public function getToken(): string {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void {
        $this->token = $token;
    }

    /**
     * @return int
     */
    public function getUserId(): int {
        return $this->user_id;
    }

    /**
     * @param int $user_id
     */
    public function setUserId(int $user_id): void {
        $this->user_id = $user_id;
    }

    /**
     * @return string
     */
    public function getExpires(): string {
        return $this->expires;
    }

    /**
     * @param string $expires
     */
    public function setExpires(string $expires): void {
        $this->expires = $expires;
    }
}