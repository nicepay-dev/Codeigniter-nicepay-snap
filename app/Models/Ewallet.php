<?php

namespace App\Models;

class Ewallet
{

    // SNAP 

    private $partnerReferenceNo;
    private $merchantId;
    private $subMerchantId;
    private $externalStoreId;
    private $validUpTo;
    private $pointOfInitiation;
    private array $amount;
    private array $additionalInfo;
    private array $urlParam;

    function __construct(EwalletBuilder $builder)
    {
        // SNAP

        $this->partnerReferenceNo = $builder->getPartnerReferenceNo();
        $this->merchantId = $builder->getMerchantId();
        $this->subMerchantId = $builder->getSubMerchantId();
        $this->externalStoreId = $builder->getExternalStoreId();
        $this->validUpTo = $builder->getValidUpTo();
        $this->pointOfInitiation = $builder->getPointOfInitiation();
        $this->amount = $builder->getAmount();
        $this->additionalInfo = $builder->getAdditionalInfo();
        $this->urlParam = $builder->getUrlParam();
    }

    public static function builder(): EwalletBuilder
    {
        return new EwalletBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            "partnerReferenceNo" => $this->partnerReferenceNo,
            "merchantId" => $this->merchantId,
            "subMerchantId" => $this->subMerchantId,
            "externalStoreId" => $this->externalStoreId,
            "validUpTo" => $this->validUpTo,
            "pointOfInitiation" => $this->pointOfInitiation,
            "amount" => $this->amount,
            "additionalInfo" => $this->additionalInfo,
            "urlParam" => $this->urlParam,
        ];
    }
}

class EwalletBuilder
{

    // SNAP

    private $partnerReferenceNo;
    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $serviceCode;
    private $transactionDate;
    private $externalStoreId;
    private $validUpTo;
    private $pointOfInitiation;
    private array $amount = [];
    private array $additionalInfo = [];
    private array $urlParam = [];

    // GETTER SNAP

    public function getPartnerReferenceNo(): mixed
    {
        return $this->partnerReferenceNo;
    }

    public function getMerchantId(): mixed
    {
        return $this->merchantId;
    }

    public function getSubMerchantId()
    {
        return $this->subMerchantId;
    }

    public function getOriginalPartnerReferenceNo()
    {
        return $this->originalPartnerReferenceNo;
    }

    public function getOriginalReferenceNo()
    {
        return $this->originalReferenceNo;
    }

    public function getServiceCode()
    {
        return $this->serviceCode;
    }

    public function getTransactionDate()
    {
        return $this->transactionDate;
    }

    public function getExternalStoreId()
    {
        return $this->externalStoreId;
    }

    public function getValidUpTo()
    {
        return $this->validUpTo;
    }

    public function getPointOfInitiation()
    {
        return $this->pointOfInitiation;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    public function getUrlParam()
    {
        return $this->urlParam;
    }

    // SETTER SNAP

    public function setPartnerReferenceNo($partnerReferenceNo): EwalletBuilder
    {
        $this->partnerReferenceNo = $partnerReferenceNo;
        return $this;
    }

    public function setMerchantId($merchantId): EwalletBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setSubMerchantId($subMerchantId): EwalletBuilder
    {
        $this->subMerchantId = $subMerchantId;
        return $this;
    }

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo): EwalletBuilder
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo): EwalletBuilder
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setServiceCode($serviceCode): EwalletBuilder
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }

    public function setTransactionDate($transactionDate): EwalletBuilder
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function setExternalStoreId($externalStoreId): EwalletBuilder
    {
        $this->externalStoreId = $externalStoreId;
        return $this;
    }

    public function setValidUpTo($validUpTo): EwalletBuilder
    {
        $this->validUpTo = $validUpTo;
        return $this;
    }

    public function setPointOfInitiation($pointOfInitiation): EwalletBuilder
    {
        $this->pointOfInitiation = $pointOfInitiation;
        return $this;
    }

    public function setUrlParam(array $urlParams): self
    {
        $urlParamList = [];

        foreach ($urlParams as $params) {
            if (count($params) === 3) {
                $paramListMap = [
                    "url" => $params[0],
                    "type" => $params[1],
                    "isDeeplink" => $params[2]
                ];
                $urlParamList[] = $paramListMap;
            }
        }

        $this->urlParam = $urlParamList;
        return $this;
    }

    public function setAmount($value, $currency): EwalletBuilder
    {
        $amount = [
            "value" => $value,
            "currency" => $currency,
        ];
        $this->amount = $amount;
        return $this;
    }

    public function setAdditionalInfo($additionalInfo): EwalletBuilder
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function setAddInfoMitraCd($mitraCd): EwalletBuilder
    {
        $this->additionalInfo["mitraCd"] = $mitraCd;
        return $this;
    }

    public function setAddInfoGoodsNm($goodsNm): EwalletBuilder
    {
        $this->additionalInfo["goodsNm"] = $goodsNm;
        return $this;
    }
    public function setAddInfoBillingNm($billingNm): EwalletBuilder
    {
        $this->additionalInfo["billingNm"] = $billingNm;
        return $this;
    }

    public function setAddInfoBillingPhone($billingPhone): EwalletBuilder
    {
        $this->additionalInfo["billingPhone"] = $billingPhone;
        return $this;
    }

    public function setAddInfoCallBackUrl($callBackUrl): EwalletBuilder
    {
        $this->additionalInfo["callBackUrl"] = $callBackUrl;
        return $this;
    }

    public function setAddInfoDbProcessUrl($dbProcessUrl): EwalletBuilder
    {
        $this->additionalInfo["dbProcessUrl"] = $dbProcessUrl;
        return $this;
    }

    public function setAddInfoCartData($cartData): EwalletBuilder
    {
        $this->additionalInfo["cartData"] = $cartData;
        return $this;
    }

    public function setAddInfoMsId($msId): EwalletBuilder
    {
        $this->additionalInfo["msId"] = $msId;
        return $this;
    }

    public function setAddInfoMsfee($msfee): EwalletBuilder
    {
        $this->additionalInfo["msfee"] = $msfee;
        return $this;
    }

    public function setAddInfoMsfeetype($msfeetype): EwalletBuilder
    {
        $this->additionalInfo["msfeetype"] = $msfeetype;
        return $this;
    }

    public function setAddInfoMbfee($mbfee): EwalletBuilder
    {
        $this->additionalInfo["mbfee"] = $mbfee;
        return $this;
    }

    public function setAddInfoMbfeetype($mbfeetype): EwalletBuilder
    {
        $this->additionalInfo["mbfeetype"] = $mbfeetype;
        return $this;
    }

    public function build(): Ewallet
    {
        return new Ewallet($this);
    }
}
