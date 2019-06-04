<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use UuidTrait;

    protected $table = "transactions";

    public function user() {
        return $this->belongsTo(BankUser::class);
    }
}
