<?php
namespace App\Http\Interfaces;


interface UserInterface
{

    public function getUserById($userId);

    public function create($login, $password, $isMan, $imagePath);
}
