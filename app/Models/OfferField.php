<?php

namespace App\Models;

use \DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OfferField extends Model
{
    use SoftDeletes;
    use HasFactory;

    public $table = 'offer_fields';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'offer_id',
        'field_id',
        'value',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function offer()
    {
        return $this->belongsTo(Offer::class, 'offer_id');
    }

    public function field()
    {
        return $this->belongsTo(Field::class, 'field_id');
    }

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
