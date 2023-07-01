<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    use HasFactory;
    protected $table = 'patient';
    protected $fillable = ['nik', 'name', 'gender', 'age', 'phone', 'address', 'disease', 'desc'];
}
