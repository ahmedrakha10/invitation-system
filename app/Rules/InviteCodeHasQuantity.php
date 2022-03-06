<?php

namespace App\Rules;

use App\Models\InviteCode;
use Illuminate\Contracts\Validation\Rule;

class InviteCodeHasQuantity implements Rule
{

    public function __construct(protected ?InviteCode $inviteCode)
    {
    }


    public function passes($attribute, $value)
    {
        return optional($this->inviteCode)->hasAvailableQuantity();
    }


    public function message()
    {
        return 'The code has reached the maximum usage.';
    }
}
