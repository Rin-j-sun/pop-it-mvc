<?php

namespace Validators;

use Src\Validator\AbstractValidator;

class CyrillicValidator extends AbstractValidator
{

    protected string $message = 'Поле :field должно содержать только кириллицу';

    public function rule(): bool
    {
        // Проверка на русскую раскладку
        return preg_match('/^[а-яёА-ЯЁ\s]+$/u', $this->value);
    }

}