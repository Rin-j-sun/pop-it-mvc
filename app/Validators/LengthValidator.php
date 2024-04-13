<?php

//Валидация длины заполнения полей
class LengthValidator extends AbstractValidator
{
    protected string $message = 'Field :field must be between :min and :max characters long';
    protected int $min;
    protected int $max;

    public function __construct(int $min, int $max)
    {
        $this->min = $min;
        $this->max = $max;
    }

    public function rule(): bool
    {
        $length = strlen($this->value);
        return $length >= $this->min && $length <= $this->max;
    }
}
