<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class users extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "users";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * Adds New User to Database
     *
     * @param  stdClass $user
     * user will contains this elements
     * <code>
     * $nickname - user nickname
     * $password - user password
     * $email - user email
     * $email - user email
     * </code>
     * @return \Illuminate\Http\RedirectResponse
     */
    public function addNewUser($user) {

    }

}
