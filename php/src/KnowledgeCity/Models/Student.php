<?php

namespace KnowledgeCity\Models;

class Student extends Model
{

    protected const TABLE = 'students';

    public string $username;
    public string $name;
    public string $last_name;

    /**
     * @return string
     */
    public function getUsername(): string {
        return $this->username;
    }

    /**
     * @param string $username
     */
    public function setUsername(string $username): void {
        $this->username = $username;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getLastName(): string {
        return $this->last_name;
    }

    /**
     * @param string $last_name
     */
    public function setLastName(string $last_name): void {
        $this->last_name = $last_name;
    }

}