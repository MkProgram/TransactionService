<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class BankUser extends Model
{
    protected $table = "bank_users";

    public function transactions():hasMany {
        return $this->hasMany(Transaction::class, 'user_id');
    }
}
