<?php

declare (strict_types=1);

namespace App\Console\Enums;


enum RoleEnum:string
{
    CASE SUPER_ADMIN='Super Admin';

    CASE TEACHER= 'teacher';
    
    CASE STUDENT= 'student';
}