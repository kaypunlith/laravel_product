<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItems extends Model
{
    use HasFactory;

    protected $table = "order_items";
    protected $primaryKey = "id";
    protected $fillable = [
        'orderId','proId', 'quantity', 'amount'
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'proId');
    }

}
