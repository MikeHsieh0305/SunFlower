<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Administrator extends Model
{
    use HasFactory;
    protected $fillable = [
        'Name', 
        'UserName',
        'Password',
        'Status',
        'Menu_ID'
    ];   
    protected $hidden = [
        'password',
        'Status',
    ]; 
}
