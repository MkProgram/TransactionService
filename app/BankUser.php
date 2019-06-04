<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class BankUser extends Model
{
    use UuidTrait;

    /**
     * Indicates if the IDs are auto-incrementing.
     * @var bool
     */
    public $incrementing = false;

    protected $table = "bank_users";

    public function transactions() {

        return $this->hasMany(Transaction::class);
    }
}
