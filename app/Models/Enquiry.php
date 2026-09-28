<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'item_id',
        'item_name',
        'name',
        'email',
        'phone',
        'company',
        'quantity_requirement',
        'message',
        'status',
        'admin_notes',
    ];

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }
}
