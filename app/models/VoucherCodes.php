<?php
namespace App\Models;
use \Illuminate\Database\Eloquent\Model;

class VoucherCodes extends Model {

    // each VoucherCode HAS one Recipient
    public function recipient() {
        return $this->hasOne('Recipient'); // this matches the Eloquent model
    }

    // each VoucherCode HAS one SpecialOffer
    public function specialOffer() {
        return $this->hasOne('SpecialOffer'); // this matches the Eloquent model
    }


    public function findAllByEmail($email)
    {
        return self::where('recipient_email', '=', $email)->select('recipient_email','special_offer_link', 'recipient_link', 'voucher_uuid')->get();
    }
}