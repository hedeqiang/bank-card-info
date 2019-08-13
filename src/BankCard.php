<?php

namespace Hedeqiang\BankCardInfo;

use GuzzleHttp\Client;
use Hedeqiang\BankCardInfo\Exceptions\HttpException;
use Hedeqiang\BankCardInfo\Exceptions\InvalidArgumentException;

class BankCard
{

    protected $guzzleOptions = [];

    public function getHttpClient()
    {
        return new Client($this->guzzleOptions);
    }

    public function setGuzzleOptions(array $options)
    {
        $this->guzzleOptions = $options;
    }

    public function getInfo($cardNum)
    {
        if(!is_numeric($cardNum))
        {
            throw new InvalidArgumentException('Invalid cardNum: '.$cardNum);
        }

        $url = "https://ccdcapi.alipay.com/validateAndCacheCardInfo.json?_input_charset=utf-8&cardNo={$cardNum}&cardBinCheck=true";

        try{
            $response = $this->getHttpClient()->get($url)->getBody()->getContents();

            //$response = json_decode($response, true);
            $response = \GuzzleHttp\json_decode($response);
            
           
           // return $response;

            if (!$response->validated) {
                $bankInfo =[
                    'validated' => $response->validated
                ];
            } else {
                $bankInfo = array(
                    'validated'    => $response->validated,              // 是否验证通过
                    'bank'         => $response->bank,                        // 银行代码
                    'bankName'     => BankName::getBankName($response->bank) ?? '',   // 银行名称
                    'bankImg'      => BankName::getBankImg($response->bank),
                    'cardType'     => $response->cardType,                // 银行卡类型, CC 信用卡, DC 储蓄卡
                    'cardTypeName' => BankName::getCardType($response->cardType),
                );
            }

            return $bankInfo;


        } catch (\Exception $e) {
            throw new HttpException($e->getMessage(), $e->getCode(), $e);
        }
    }
}