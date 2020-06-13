<?php

namespace App\Models;

use \Illuminate\Database\Eloquent\Model as LaravelModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends LaravelModel {


    const APPENDS = ['created_at_date', 'updated_at_date'];
    const GUARDED = ['id'];
    const HIDDEN = [];

    protected $appends = self::APPENDS;
    protected $guarded = self::GUARDED;
    protected $hidden = self::HIDDEN;

    protected function appends($appends) {
        return array_merge(self::APPENDS, $appends);
    }

    protected function hidden($hidden) {
        return array_merge(self::HIDDEN, $hidden);
    }

    protected function guarded($guarded) {
        return array_merge(self::GUARDED, $guarded);
    }

    protected function serializeDate(\DateTimeInterface $date) {
        return $date->format('Y-m-d H:i:s');
    }

    public function getCreatedAtDateAttribute() {
        return ! empty($this->attributes['created_at']) ? substr($this->attributes['created_at'], 2, 8) : null;
    }

    public function getUpdatedAtDateAttribute() {
        return ! empty($this->attributes['updated_at']) ? substr($this->attributes['updated_at'], 2, 8) : null;
    }

}