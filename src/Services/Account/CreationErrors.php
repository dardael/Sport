<?php
declare(strict_types=1);

namespace App\Services\Account;

enum CreationErrors: string
{
    case EMAIL_IS_EMPTY = 'Mail cannot be empty';
    case EMAIL_IS_EXISTING = 'This mail already exists';
    case PSEUDO_IS_EMPTY = 'Pseudo cannot be empty';
    case PSEUDO_IS_EXISTING = 'This pseudo already exists';
    case PASSWORD_IS_EMPTY = 'Password cannot be empty';
    case REPEATED_PASSWORD_DIFFERENT = 'Password and repeated password cannot be different';
}
