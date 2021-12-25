<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class UsersModel extends Model
{
    // TODO get user
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
     *
     * User standart class will contains this elements
     *
     * @param string $user->nickname
     * User nickname
     *
     * @param string $user->password
     * User password
     *
     * @param string $user->email
     * User email(will be unique)
     *
     * @param boolean $user->is_mail_hidden
     * True if users e-mail hidden
     *
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
     * Delete'selected user
     *
     * @param  string $nickname
     * Users nickname
     *
     * @return void
     */
    public function delete_user(string $nickname) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->delete();
    }

    /**
     * Gets selected user
     *
     * @param  string $nickname
     * Users nickname
     *
     * @return Illuminate\Support\Collection collection of the results
     * returns user' everything except password
     */
    public function get_user(string $nickname) {
        return
        DB::table("users")
            ->select([
                "nickname",
                "email",
                "is_mail_hidden",
                "is_moderator",
                "is_admin",
                "is_founder",
                "last_activity"
            ])
            ->where("nickname", $nickname);
    }

    /**
     * Gets selected user' login information
     *
     * @param  string $nickname
     * Users nickname
     *
     * @return Illuminate\Support\Collection collection of the results
     */
    public function get_login(string $nickname) {
        return
        DB::table("users")
            ->select([
                "email",
                "password"
            ])
            ->where("nickname", $nickname);
    }

    /**
     * Changes selected user' e-mail
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  string $email
     * Users email
     *
     * @return void
     */
    public function ch_email(string $nickname, string $email) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["email" => $email]);
    }

    /**
     * Changes selected user' nickname
     *
     * @param  string $oldNickname
     * Users nickname
     *
     * @param  string $newNickname
     * Users email
     *
     * @return void
     */
    public function ch_nickname(string $oldNickname, string $newNickname) {
        DB::table("users")
            ->where("nickname", $oldNickname)
            ->update(["nickname" => $newNickname]);
    }

    /**
     * Changes selected user' password
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  string $password
     * Users password
     *
     * @return void
     */
    public function ch_password(string $nickname, string $password) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["password" => $password]);
    }

    /**
     * Changes users mail visibility
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  bool $is_mail_hidden
     * True if user' mail hidden
     *
     * @return void
     */
    public function ch_mail_status(string $nickname, bool $is_mail_hidden) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["is_mail_hidden" => $is_mail_hidden]);
    }

    /**
     * Changes selected user' moderate state
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  bool $is_moderator
     * True if user will be moderator
     *
     * @return void
     */
    public function ch_moderator(string $nickname, bool $is_moderator) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["is_moderator" => $is_moderator]);
    }

    /**
     * Changes selected user' administration state
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  bool $is_admin
     * True if user will be administrator
     *
     * @return void
     */
    public function ch_admin(string $nickname, bool $is_admin) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["is_admin" => $is_admin]);
    }

    /**
     * Changes selected user' founder state
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  bool $is_founder
     * True if user will be founder
     *
     * @return void
     */
    public function ch_founder(string $nickname, bool $is_founder) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["is_founder" => $is_founder]);
    }

    /**
     * Changes selected user' last activity
     *
     * @param  string $nickname
     * Users nickname
     *
     * @param  timestamp $last_activity
     * Will be integer timestamp
     *
     * @return void
     */
    public function ch_last_activity(string $nickname, $last_activity) {
        DB::table("users")
            ->where("nickname", $nickname)
            ->update(["last_activity" => $last_activity]);
    }
}
