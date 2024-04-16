<?php

namespace Validators;

use Src\Validator\AbstractValidator;

//Валидация длины поля логин
class UsernameLengthValidator extends AbstractValidator
{
    protected string $message = 'Логин должен содержать от 5 до 8 символов';

    public function rule(): bool
    {
        $loginLength = strlen($this->value);
        return $loginLength >= 5 && $loginLength <= 8;
    }
}


