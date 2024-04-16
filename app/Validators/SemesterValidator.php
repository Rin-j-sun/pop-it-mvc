<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class SemesterValidator extends AbstractValidator
{

    protected string $message = 'Номер семестра не может превышать 12';

    public function rule(): bool
    {
        // Проверка, что значение является числом и не превышает 6
        return is_numeric($this->value) && intval($this->value) <= 12;
    }

}