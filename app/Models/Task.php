<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'author_user_id',
        'assigned_user_id',
        'status_id',
        'parent_id'
    ];

    public function assignedUser(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_user_id');
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function childTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'parent_id');
    }
    public function parentTask(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
