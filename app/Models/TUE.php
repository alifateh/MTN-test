<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TUE extends Model
{
    use HasFactory;
    public $table = 'TUE';
    protected $fillable = ['UserRef', 'TicketRef', 'Cost', 'TCap', 'CCap', 'Vat', 'ToCost'];
}
