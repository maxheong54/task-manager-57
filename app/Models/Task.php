<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    /** @use HasFactory<\Database\Factories\TaskFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by_id',
        'assigned_to_id',
    ];

    /**
     * @return BelongsTo<TaskStatus, Task>
     */
    public function status(): BelongsTo
    {
        /** @var BelongsTo<TaskStatus, Task> */
        return $this->belongsTo(TaskStatus::class, 'status_id');
    }

    /**
     * @return BelongsTo<User, Task>
     */
    public function author(): BelongsTo
    {
        /** @var BelongsTo<User, Task> */
        return $this->belongsTo(User::class, 'created_by_id');
    }

    /**
     * @return BelongsTo<User, Task>
     */
    public function executor(): BelongsTo
    {
        /** @var BelongsTo<User, Task> */
        return $this->belongsTo(User::class, 'assigned_to_id');
    }
}
