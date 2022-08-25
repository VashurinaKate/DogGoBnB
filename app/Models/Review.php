<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        
        'rating',
        'comment',
        
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function reviewsThat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        
        return $this->belongsTo(User::class, 'that_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function reviewsWhom(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        
        return $this->belongsTo(User::class, 'to_whom_id', 'id');
    }
}
