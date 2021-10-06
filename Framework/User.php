<?php

namespace Frame;

class User
{
    function __construct(
        private string $pseudo = 'guest',
        private ?string $login = null,
        private ?string $password = null,
        private ?string $email = null,
        private ?Grants $grant = null,
    ) {
        if (isset($_SESSION['objUser']))
            foreach ($_SESSION['objUser'] as $key => $value)
                $this->$key = $value;
    }

    function __destruct()
    {
        $_SESSION['objUser'] = get_object_vars($this);
    }
}
