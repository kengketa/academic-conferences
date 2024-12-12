<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'type',
        'organized_by',
        'number_of_seminar_done',
        'references',
        'relate_majors',
        'relate_curriculum',
        'other_info',
        'proposed_by',
        'proposer_signature',
        'proposed_at',
        'dean_comment',
        'dean_signature',
        'dean_commented_by',
        'dean_commented_at',
        'chairman_comment',
        'chairman_signature',
        'chairman_commented_by',
        'chairman_commented_at',
        'president_comment',
        'president_signature',
        'president_commented_by',
        'president_commented_at',
        'secretary_comment',
        'secretary_signature',
        'secretary_commented_by',
        'secretary_commented_at',
        'status'
    ];

    protected $casts = [
        'organized_by' => 'array',
        'references' => 'array',
        'relate_majors' => 'array',
        'relate_curriculum' => 'array',
        'proposed_at' => 'datetime',
        'dean_commented_at' => 'datetime',
        'chairman_commented_at' => 'datetime',
        'president_commented_at' => 'datetime',
        'secretary_commented_at' => 'datetime',
    ];
}
