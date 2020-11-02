<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Player;

class Team extends Model
{
    use SoftDeletes;
    /**
     * The table associated with the model
     *
     * @var string
     */
    protected $table = 'teams';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'team_name',
    ];

    /**
     * Indicates if the model should be timestamped
     *
     * @var bool
     */
    public $timestamps = true;

    /**
     * Indicates if the ID is auto-incrementing
     *
     * @var bool
     */
    public $incrementing = true;

    public function players() {
        return $this->hasMany(Player::class);
    }
}
