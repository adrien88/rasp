<?php

namespace Frame;

class User
{
    public $id;
    public $pseudo = 'Guest';
    private $login = null;
    private $password = null;
    private $email = null;
    private $status = 'guest';
}
