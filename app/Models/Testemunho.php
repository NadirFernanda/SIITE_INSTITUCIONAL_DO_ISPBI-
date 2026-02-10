<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Lightweight alias model for legacy references to App\Models\Testemunho.
 * Extends Alumnus so existing alumni/testimony data can be used transparently.
 */
class Testemunho extends Alumnus
{
    // Intentionally empty: inherits from Alumnus which contains the fields used by the views.
}
