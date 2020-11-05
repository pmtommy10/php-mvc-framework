<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    protected static $tb_name = 'user';
    protected static $tb_abbr = 'u';
    protected static $tb_primary_key = 'id';

    protected $id;
    protected $username;
    protected $password;
    protected $firstname;
    protected $lastname;
    protected $sex;
    protected $email;
    protected $phone;
    protected $address;
    protected $position;
    protected $status;

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->firstname = $data['firstname'] ?? null;
        $this->lastname = $data['lastname'] ?? null;
        $this->sex = $data['sex'] ?? null;
        $this->email = $data['email'] ?? null;
        $this->phone = $data['phone'] ?? null;
        $this->address = $data['address'] ?? null;
        $this->position = $data['position'] ?? null;
        $this->status = $data['status'] ?? 0;
    }
}
