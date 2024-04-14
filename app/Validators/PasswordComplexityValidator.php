<?php

namespace Validators;

use Src\Validator\AbstractValidator;

//валидатор на сложность пароля
class PasswordComplexityValidator extends AbstractValidator
{

    protected string $message = 'Field :field must contain only english letters and numbers';

    public function rule(): bool
    {
        // Проверка на английскую раскладку и цифры
        return preg_match('/^[a-zA-Z0-9]+$/', $this->value);
    }
}

