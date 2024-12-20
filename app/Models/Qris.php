<?php

namespace App\Models;

class Qris
{

    // SNAP 

    private $partnerReferenceNo;
    private array $amount;
    private $merchantId;
    private $storeId;
    private $validityPeriod;
    private $additionalInfo;

    function __construct(QrisBuilder $builder)
    {
        // SNAP

        $this->partnerReferenceNo = $builder->getPartnerReferenceNo();
        $this->amount = $builder->getAmount();
        $this->merchantId = $builder->getMerchantId();
        $this->storeId = $builder->getStoreId();
        $this->validityPeriod = $builder->getValidityPeriod();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    public static function builder(): QrisBuilder
    {
        return new QrisBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            "partnerReferenceNo" => $this->partnerReferenceNo,
            "merchantId" => $this->merchantId,
            "storeId" => $this->storeId,
            "validityPeriod" => $this->validityPeriod,
            "amount" => $this->amount,
            "additionalInfo" => $this->additionalInfo,
        ];
    }
}

class QrisBuilder
{

    // SNAP

    private $partnerReferenceNo;
    private array $amount;
    private $merchantId;
    private $storeId;
    private $validityPeriod;
    private $additionalInfo;

    // GETTER SNAP

    public function getPartnerReferenceNo(): string
    {
        return $this->partnerReferenceNo;
    }
    public function getAmount(): array
    {
        return $this->amount;
    }
    public function getMerchantId(): string
    {
        return $this->merchantId;
    }
    public function getStoreId(): string
    {
        return $this->storeId;
    }
    public function getValidityPeriod(): string
    {
        return $this->validityPeriod;
    }
    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setPartnerReferenceNo(string $partnerReferenceNo): QrisBuilder
    {
        $this->partnerReferenceNo = $partnerReferenceNo;
        return $this;
    }
    public function setAmount($value, $currency): QrisBuilder
    {
        $this->amount = [
            "value" => $value,
            "currency" => $currency,
        ];
        return $this;
    }
    public function setMerchantId(string $merchantId): QrisBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }
    public function setStoreId(string $storeId): QrisBuilder
    {
        $this->storeId = $storeId;
        return $this;
    }
    public function setValidityPeriod(string $validityPeriod): QrisBuilder
    {
        $this->validityPeriod = $validityPeriod;
        return $this;
    }
    public function setAdditionalInfo(
        $goodsNm,
        $billingNm,
        $billingPhone,
        $billingEmail,
        $billingCity,
        $billingAddr,
        $billingState,
        $billingPostCd,
        $billingCountry,
        $callBackUrl,
        $dbProcessUrl,
        $userIP,
        $cartData,
        $mitraCd
    ): QrisBuilder {
        $this->additionalInfo = [
            "goodsNm" => $goodsNm,
            "billingNm" => $billingNm,
            "billingPhone" => $billingPhone,
            "billingEmail" => $billingEmail,
            "billingCity" => $billingCity,
            "billingAddr" => $billingAddr,
            "billingState" => $billingState,
            "billingPostCd" => $billingPostCd,
            "billingCountry" => $billingCountry,
            "callBackUrl" => $callBackUrl,
            "dbProcessUrl" => $dbProcessUrl,
            "userIP" => $userIP,
            "cartData" => $cartData,
            "mitraCd" => $mitraCd,
        ];
        return $this;
    }

    public function build(): Qris
    {
        return new Qris($this);
    }
}
