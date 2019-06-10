<?php


namespace App;


use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

trait UuidTrait
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            $model->{$model->getKeyName()} = Uuid::generate()->string;
        });
    }
}