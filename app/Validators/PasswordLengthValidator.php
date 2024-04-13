<?php

namespace Validators;


//Валидация длины поля логин
class PasswordLengthValidator extends LengthValidator
{
    public function __construct()
    {
        parent::__construct(8, 20);
    }
}




