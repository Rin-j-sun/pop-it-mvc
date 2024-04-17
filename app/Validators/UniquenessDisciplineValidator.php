<?php

namespace Validators;

use Illuminate\Database\Capsule\Manager as Capsule;
use Src\Validator\AbstractValidator;
class UniquenessDisciplineValidator extends AbstractValidator
{
    protected string $message = 'Field :field is required';

    public function rule(): bool
    {
        $groupId = $this->args[0];
        $disciplineId = $this->value;
        $exists = Capsule::table('groupe_disciplines')->where('group_id',$groupId)->where('discipline_id',$disciplineId)->exists();
        return !$exists;
    }
}
