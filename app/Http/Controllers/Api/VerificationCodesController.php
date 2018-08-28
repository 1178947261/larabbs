<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Http\Request;
use Overtrue\EasySms\EasySms;

class VerificationCodesController extends Controller
{
    public function store(VerificationCodeRequest $request,EasySms $easySms)
    {
        //接收手机号
        $phone = $request->phone;
        //生成随机数
       # $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
        $code = 1997;
        /**
        try {
            $result = $easySms->send($phone, [
                'content'  =>  "【Lbbs社区】您的验证码是{$code}。如非本人操作，请忽略本短信"
            ]);
        } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
            $message = $exception->getException('yunpian')->getMessage();
            return $this->response->errorInternal($message ?? '短信发送异常');
        }**/
        //缓存key
        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10); //过期时间戳
        // 缓存验证码 10分钟过期。
        \Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }
}