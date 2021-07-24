<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GatewayCurrency extends Model
{
    protected $casts = ['status' => 'boolean'];
    protected $guarded = ['id'];

    // Relation

    public function method()
    {
        return $this->belongsTo(Gateway::class, 'method_code', 'code');
    }

    public function currencyIdentifier()
    {
        return $this->name ?? $this->method->name . ' ' . $this->currency;
    }


    public function scopeBaseCurrency()
    {
        return $this->method->crypto == 1 ? 'USD' : $this->currency;
    }


    public function scopeBaseSymbol()
    {
        return $this->method->crypto == 1 ? '$' : $this->symbol;
    }

    public function scopeMethodImage()
    {
        $path = config('constants.deposit.gateway.path');
        if($this->method_code >= 1000) {
            $gateway_currency_image =  $path . '/' . $this->method->image;
            $gateway_image = config('constants.image.default');
        }else{
            $gateway_image = $path . '/' . $this->method->image;
            $gateway_currency_image = $path . '/' . $this->image;
        }
        return file_exists($gateway_currency_image) && is_file($gateway_currency_image) ? asset($gateway_currency_image) : asset($gateway_image);
    }
}
