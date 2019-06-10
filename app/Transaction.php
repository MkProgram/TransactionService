<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed userId
 * @property mixed iban
 */
class Transaction extends Model
{
    use UuidTrait;

    protected $table = "transactions";

    /**
     * @return BelongsTo
     */
    public function user():BelongsTo {
        return $this->belongsTo(BankUser::class);
    }
}
