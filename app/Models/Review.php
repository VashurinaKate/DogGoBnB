<?php
declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'that_id',
        'to_whom_id',
        'rating',
        'comment',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   
    public function reviewsThat(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        
        return $this->belongsTo(User::class, 'that_id', 'id');
    }
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function reviewsWhom(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        
        return $this->belongsTo(User::class, 'to_whom_id', 'id');
    }
}
