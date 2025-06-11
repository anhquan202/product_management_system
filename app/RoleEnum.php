<?php

namespace App;

enum RoleEnum: string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN = 'admin';
    case EMPLOYEE = 'employee';
}
