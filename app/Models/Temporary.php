<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $email
 * @property int $code
 * @property int $retries
 * @property Carbon $send_at
 */
class Temporary extends Model
{
    use HasFactory;

    protected $casts = [
        'send_at' => 'datetime'
    ];

    protected $fillable = [
        'email',
        'code',
        'retries',
        'send_at',
    ];
}
