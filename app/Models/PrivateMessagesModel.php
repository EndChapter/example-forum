<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
     *
     * private_message class will contains this elements
     * <code>
     * @param string from - sender(nickname)
     * @param string to - to be sent(nickname)
     * @param string subject - subject of the private message
     * @param string content - content of the private message
     * </code>
     *
     * @return void
     */
    public function send_private_message($private_message) {
        DB::table("private_messages")
            ->insert([
                "from" => $private_message->from,
                "to" => $private_message->to,
                "subject" => $private_message->subject,
                "content" => $private_message->content
            ]);
    }

    /**
     * Gets inbox
     *
     * @param string nickname - Users nickname
     *
     * @return Illuminate\Support\Collection
     */
    public function get_inbox($nickname) {
        return
        DB::table("private_messages")
            ->where("to", $nickname);
    }

    /**
     * Gets inbox
     *
     * @param string nickname - Users nickname
     *
     * @return Illuminate\Support\Collection
     */
    public function get_outbox($nickname) {
        return
        DB::table("private_messages")
            ->where("from", $nickname);
    }

    /**
     *  Set seen status for inbox
     *
     * @param string nickname - Users nickname
     * @param string id - message id
     *
     * @return void
     */
    public function seen_by_to($nickname, $id) {
        DB::table("private_messages")
            ->select("seen_by_to")
            ->where("to", $nickname)
            ->where("id", $id)
            ->delete();
    }
}
