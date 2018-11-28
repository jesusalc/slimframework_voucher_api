<?php
namespace App\Models;

class SpecialOffers extends \Illuminate\Database\Eloquent\Model {
    public function voucherCodes() {
        return $this->hasMany('VoucherCodes'); // this matches the Eloquent model
    }
}