<?php

namespace App\Models;

use App\Console\Enums\SchoolEnum;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StudentCard extends Model implements HasMedia 
{
    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];

    protected $casts = [
        'school' => SchoolEnum::class,
        'is_internal' => 'boolean',
        'date_of_birth' => 'date',
    ];
    public function registerMediaCollections(): void
{
    $this->addMediaCollection('pdf')->singleFile();
}
    /**
     * @return BelongsTo<User, StudentCard>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
