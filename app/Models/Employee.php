<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
                    'first_name',
                    'last_name',
                    'gender',
                    'mobile',
                    'email',
                    'company_id',
                    'status',
                ];
    protected $dates = ['deleted_at'];
}
