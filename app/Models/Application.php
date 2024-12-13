<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Image\Manipulations;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Application extends Model implements HasMedia
{
    use HasFactory;
    use InteractsWithMedia;

    public const MEDIA_COLLECTION_DOCUMENTS = 'documents';

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

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection(self::MEDIA_COLLECTION_DOCUMENTS);
    }

    public function scopeFilter(Builder $query, array $filters): void
    {
        if (isset($filters['tab']) && $filters['tab'] !== 'all' && $filters['tab'] === 'pending') {
            $query->where('status', '<', 6);
        }
        if (isset($filters['tab']) && $filters['tab'] !== 'all' && $filters['tab'] === 'done') {
            $query->where('status', '=', 6);
        }
        if (!empty($filters['search'])) {
            $query->where(function ($query) use ($filters) {
                $query->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhereHas('proposedBy', function ($query) use ($filters) {
                        $query->where('name', 'like', '%' . $filters['search'] . '%');
                    });
            });
        }
    }

    public function proposedBy()
    {
        return $this->belongsTo(User::class, 'proposed_by');
    }

    public function deanCommentedBy()
    {
        return $this->belongsTo(User::class, 'dean_commented_by');
    }

    public function chairmanCommentedBy()
    {
        return $this->belongsTo(User::class, 'chairman_commented_by');
    }

    public function presidentCommentedBy()
    {
        return $this->belongsTo(User::class, 'president_commented_by');
    }

    public function secretaryCommentedBy()
    {
        return $this->belongsTo(User::class, 'secretary_commented_by');
    }
}
