<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'booking_trx_id',
        'city',
        'post_code',
        'proof',
        'shoe_size',
        'address',
        'quantity',
        'sub_total_amount',
        'grand_total_amount',
        'discount_amount',
        'is_paid',
        'shoe_id',
        'promo_code_id'
    ];

    public static function generateUniqueTrxId()
    {
        $prefix = 'TVS';

        do {
            $randomString = $prefix . mt_rand(1000, 99990);
        } while (self::where('booking_trx_id', $randomString)->exist());

        return $randomString;
    }

    public function shoe(): BelongsTo
    {
        return $this->belongsTo(Shoe::class, 'shoe_id');
    }

    public function promoCode(): BelongsTo
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }
}
