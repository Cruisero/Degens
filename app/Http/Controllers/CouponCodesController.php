<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CouponCode;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Exceptions\CouponCodeUnavailableException;


class CouponCodesController extends Controller
{

    public function show($code)
    {

        if (!$record = CouponCode::where('code', $code)->first()) {
            throw new CouponCodeUnavailableException('优惠券不存在');
        }

        $record->checkAvailable();

        return $record;
    }
}
