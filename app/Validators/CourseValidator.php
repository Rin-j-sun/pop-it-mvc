<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class CourseValidator extends AbstractValidator
{
    protected string $message = 'Номер курса не может превышать 6';

    public function rule(): bool
    {
        // Проверка, что значение является числом и не превышает 6
        return is_numeric($this->value) && intval($this->value) <= 6;
    }
}
