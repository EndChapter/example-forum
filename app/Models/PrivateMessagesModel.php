<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrivateMessagesModel extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected string $table = "users";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     *  Sends Private Message to user
     * @param  stdClass $private_message
     * private_message class will contains this elements
     * <code>
     * @param string from - sender(nickname)
     * @param string to - to be sent(nickname)
     * @param string subject - subject of the private message
     * @param boolean is_mail_hidden - true if users e-mail hidden
     * </code>
     * @return void
     */
    public function send_private_message($usersEmail) {
        DB::table("users")->where("email", $usersEmail)->delete();
    }


}
