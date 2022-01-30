<?php
declare(strict_types=1);

namespace App\Services\Account;

enum CreationErrors: string
{
    case EMAIL_IS_EMPTY = 'Mail cannot be empty';
    case PSEUDO_IS_EMPTY = 'Pseudo cannot be empty';
    case PASSWORD_IS_EMPTY = 'Password cannot be empty';
    case REPEATED_PASSWORD_DIFFERENT = 'Password and repeted password cannot be different';
}
