<?php

namespace Validators;

use \Validators\LengthValidator;

//Валидация длины поля логин
class UsernameLengthValidator
{
    public function __construct()
    {
        parent::__construct(5, 8);
    }
}

