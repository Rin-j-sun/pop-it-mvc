<?php

namespace Validators;

use \Validators\LengthValidator;


//Валидация длины поля логин
class PasswordLengthValidator extends LengthValidator
{
    public function __construct()
    {
        parent::__construct(8, 20);
    }
}




