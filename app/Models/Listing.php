<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Listing extends Model
{
    use HasFactory;

    /**
     * Legacy rows may have a non-standard created_at; still manage updated_at after migration.
     */
    public const UPDATED_AT = 'updated_at';

    /**
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'salary',
        'requirements',
        'benefits',
        'tags',
        'company',
        'address',
        'city',
        'state',
        'phone',
        'email',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
