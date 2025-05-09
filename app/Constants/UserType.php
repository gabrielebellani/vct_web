<?php

namespace App\Constants;

class UserType
{
    public const ADMIN = 'admin';
    public const PRESS = 'press';

    public const USERS = [
        self::ADMIN,
        self::PRESS,
    ];
}