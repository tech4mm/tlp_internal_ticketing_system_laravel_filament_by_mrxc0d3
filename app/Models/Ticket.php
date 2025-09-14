<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'status',
        'priority',
        'reported_by',
        'assigned_to',
        'client_id',
        'client_name',
        'client_email',
        'client_env',
        'client_browser',
        'client_device_model',
        'bug_est_time',
        'attachments',
        'meta',
    ];

    protected $casts = [
        'attachments' => 'array',
        'meta' => 'array',
    ];

    public function reporter()
    {
        return $this->belongsTo(User::class, 'reported_by');
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

}
