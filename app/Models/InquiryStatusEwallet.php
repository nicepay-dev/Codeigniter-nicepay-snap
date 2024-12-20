<?php

namespace App\Models;

class InquiryStatusEwallet
{

    // SNAP 

    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $serviceCode;
    private $transactionDate;
    private $externalStoreId;
    private array $amount = [];
    private $additionalInfo;

    function __construct(InquiryStatusEwalletBuilder $builder)
    {
        // SNAP

        $this->merchantId = $builder->getMerchantId();
        $this->subMerchantId = $builder->getSubMerchantId();
        $this->originalPartnerReferenceNo = $builder->getOriginalPartnerReferenceNo();
        $this->originalReferenceNo = $builder->getOriginalReferenceNo();
        $this->serviceCode = $builder->getServiceCode();
        $this->transactionDate = $builder->getTransactionDate();
        $this->externalStoreId = $builder->getExternalStoreId();
        $this->amount = $builder->getAmount();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    public static function builder(): InquiryStatusEwalletBuilder
    {
        return new InquiryStatusEwalletBuilder();
    }

    // SNAP

    public function toArray(): array
    {
        return [
            'merchantId' => $this->merchantId,
            'subMerchantId' => $this->subMerchantId,
            'originalPartnerReferenceNo' => $this->originalPartnerReferenceNo,
            'originalReferenceNo' => $this->originalReferenceNo,
            'serviceCode' => $this->serviceCode,
            'transactionDate' => $this->transactionDate,
            'externalStoreId' => $this->externalStoreId,
            'amount' => $this->amount,
            'additionalInfo' => empty($this->additionalInfo) ? (object) [] : $this->additionalInfo,
        ];
    }
}

class InquiryStatusEwalletBuilder
{

    // SNAP

    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $serviceCode;
    private $transactionDate;
    private $externalStoreId;
    private array $amount = [];
    private $additionalInfo;

    // GETTER SNAP

    public function getMerchantId(): string
    {
        return $this->merchantId;
    }

    public function getSubMerchantId(): string
    {
        return $this->subMerchantId;
    }

    public function getOriginalPartnerReferenceNo(): string
    {
        return $this->originalPartnerReferenceNo;
    }

    public function getOriginalReferenceNo(): string
    {
        return $this->originalReferenceNo;
    }

    public function getServiceCode(): string
    {
        return $this->serviceCode;
    }

    public function getTransactionDate(): string
    {
        return $this->transactionDate;
    }

    public function getExternalStoreId(): string
    {
        return $this->externalStoreId;
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setMerchantId($merchantId): InquiryStatusEwalletBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setSubMerchantId($subMerchantId): InquiryStatusEwalletBuilder
    {
        $this->subMerchantId = $subMerchantId;
        return $this;
    }

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo): InquiryStatusEwalletBuilder
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo): InquiryStatusEwalletBuilder
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setServiceCode($serviceCode): InquiryStatusEwalletBuilder
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }

    public function setTransactionDate($transactionDate): InquiryStatusEwalletBuilder
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function setExternalStoreId($externalStoreId): InquiryStatusEwalletBuilder
    {
        $this->externalStoreId = $externalStoreId;
        return $this;
    }

    public function setAmount($value, $currency): InquiryStatusEwalletBuilder
    {
        $this->amount = [
            "value" => $value,
            "currency" => $currency,
        ];
        return $this;
    }

    public function setAdditionalInfo($additionalInfo): InquiryStatusEwalletBuilder
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function build(): InquiryStatusEwallet
    {
        return new InquiryStatusEwallet($this);
    }
}
