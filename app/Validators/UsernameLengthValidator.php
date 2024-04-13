<?php

namespace Validators;

//Валидация длины поля логин
class UsernameLengthValidator
{
    public function __construct()
    {
        parent::__construct(5, 15);
    }
}

