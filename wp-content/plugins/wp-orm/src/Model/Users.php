<?php
namespace WordPress\ORM\Model;
use WordPress\ORM\BaseModel;
class Users extends BaseModel
{
    protected $id;
    protected $firstname;
    protected $lastname;
    protected $email;
    protected $password;
    protected $address_id;
    protected $salt;
    protected $username;
    protected $type;
    protected $active;
    protected $company_id;
    protected $admin;
    protected $verify;
    protected $verification_code;

    public static function get_primary_key()
    {
        return 'id';
    }

    public static function get_table()
    {
        return 'user';
    }

    // hash password
    public function hashPassword($password, $salt)
    {
        //return md5($salt.$password);
        return md5($password);
    }
            
    // password validation
    public function validatePassword($password)
    {
        return $this->password == md5($password);
    }
            
    //generate salt
    public function generateSalt()
    {
        return uniqid('',true); 
    }

    public static function get_searchable_fields()
    {
        return ['id'];
    }
}