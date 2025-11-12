<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Label extends Model
{
    /** @use HasFactory<\Database\Factories\LabelFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    /**
     * @return BelongsToMany<Task, Label, \Illuminate\Database\Eloquent\Relations\Pivot>
     */
    public function tasks(): BelongsToMany
    {
        /** @var BelongsToMany<Task, Label> */
        return $this->belongsToMany(Task::class);
    }
}
