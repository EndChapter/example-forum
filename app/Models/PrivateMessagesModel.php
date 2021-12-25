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
    protected string $table = "private_messages";

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
     * Private_message class will contains this elements
     *
     * @param string $private_message->from
     * Sender(nickname)
     *
     * @param string $private_message->to
     * To be sent(nickname)
     *
     * @param string $private_message->subject
     * Subject of the private message
     *
     * @param string $private_message->content
     * Content of the private message
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
     * @param string $nickname
     * Users nickname
     *
     * @return Illuminate\Support\Collection
     * Collection of the users inbox messages
     */
    public function get_inbox(string $nickname) {
        return
        DB::table("private_messages")
            ->where("to", $nickname);
    }

    /**
     * Gets inbox
     *
     * @param string $nickname
     * Users nickname
     *
     * @return Illuminate\Support\Collection
     * Collection of the users outbox messages
     */
    public function get_outbox(string $nickname) {
        return
        DB::table("private_messages")
            ->where("from", $nickname);
    }

    /**
     *  Set seen status for inbox
     *
     * @param string $nickname
     * Users nickname
     *
     * @param integer $id
     * Message id
     *
     * @param bool $seen
     * True if seen by to
     *
     * @return void
     */
    public function seen_by_to(string $nickname, int $id, bool $seen) {
        DB::table("private_messages")
            ->select("seen_by_to")
            ->where("to", $nickname)
            ->where("id", $id)
            ->update([
                "seen_by_to" => $seen,
            ]);
    }
}
