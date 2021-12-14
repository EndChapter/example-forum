<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
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
     * Adds New User to Database
     *
     * @param  stdClass $user
     * User class will contains this elements
     * <code>
     * @param string nickname - users nickname
     * @param string password - users password
     * @param string email - user email(will be unique)
     * @param boolean is_mail_hidden - true if users e-mail hidden
     * </code>
     * @return void
     */
    public function add_new_user($user) {
        $user->date = new DateTime();
        DB::table("users")->insert([
            "nickname" => $user->nickname,
            "password" => $user->password,
            "email" => $user->email,
            "is_mail_hidden" => $user->is_mail_hidden,
            "last_activity" => $user->date->getTimestamp()
        ]);
    }

    /**
     * Changes selected user' moderate state
     *
     * @param  string email Users e-mail
     * @param  bool is_moderator true if user will be moderator
     * @return void
     */
    public function ch_moderator($email, $is_moderator) {
        DB::table("users")->where("email", $email)->update(["is_moderator" => $is_moderator]);
    }

    /**
     * Changes selected user' administration state
     *
     * @param  string usersEmail Users e-mail
     * @param  bool email true if user will be administrator
     * @return void
     */
    public function ch_admin($email, $is_admin) {
        DB::table("users")->where("email", $email)->update(["is_admin" => $is_admin]);
    }

    /**
     * Changes selected user' founder state
     *
     * @param  string email Users e-mail
     * @param  bool is_admin true if user will be founder
     * @return void
     */
    public function ch_founder($email, $is_founder) {
        DB::table("users")->where("email", $email)->update(["is_founder" => $is_founder]);
    }

    /**
     *  Delete'selected user
     *
     * @param  string email Users e-mail
     * @return void
     */
    public function delete_user($email) {
        DB::table("users")->where("email", $email)->delete();
    }

}
