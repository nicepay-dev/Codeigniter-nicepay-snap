<?php

namespace App\Models;

class RefundEwallet
{

    // SNAP 

    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $partnerRefundNo;
    private array $refundAmount;
    private $externalStoreId;
    private $reason;
    private array $additionalInfo;

    function __construct(RefundEwalletBuilder $builder)
    {
        // SNAP

        $this->merchantId = $builder->getMerchantId();
        $this->subMerchantId = $builder->getSubMerchantId();
        $this->originalPartnerReferenceNo = $builder->getOriginalPartnerReferenceNo();
        $this->originalReferenceNo = $builder->getOriginalReferenceNo();
        $this->partnerRefundNo = $builder->getPartnerRefundNo();
        $this->refundAmount = $builder->getRefundAmount();
        $this->externalStoreId = $builder->getExternalStoreId();
        $this->reason = $builder->getReason();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    public static function builder(): RefundEwalletBuilder
    {
        return new RefundEwalletBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            'merchantId' => $this->merchantId,
            'subMerchantId' => $this->subMerchantId,
            'originalPartnerReferenceNo' => $this->originalPartnerReferenceNo,
            'originalReferenceNo' => $this->originalReferenceNo,
            'partnerRefundNo' => $this->partnerRefundNo,
            'refundAmount' => $this->refundAmount,
            'externalStoreId' => $this->externalStoreId,
            'reason' => $this->reason,
            "additionalInfo" => $this->additionalInfo,
        ];
    }
}

class RefundEwalletBuilder
{

    // SNAP

    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $partnerRefundNo;
    private array $refundAmount = [];
    private $externalStoreId;
    private $reason;
    private array $additionalInfo = [];

    // GETTER SNAP

    public function getMerchantId()
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

    public function getPartnerRefundNo()
    {
        return $this->partnerRefundNo;
    }

    public function getRefundAmount(): array
    {
        return $this->refundAmount;
    }

    public function getExternalStoreId()
    {
        return $this->externalStoreId;
    }

    public function getReason()
    {
        return $this->reason;
    }

    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setMerchantId($merchantId): RefundEwalletBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setSubMerchantId($subMerchantId): RefundEwalletBuilder
    {
        $this->subMerchantId = $subMerchantId;
        return $this;
    }

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo): RefundEwalletBuilder
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo): RefundEwalletBuilder
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setPartnerRefundNo($partnerRefundNo): RefundEwalletBuilder
    {
        $this->partnerRefundNo = $partnerRefundNo;
        return $this;
    }

    public function setRefundAmount($value, $currency): RefundEwalletBuilder
    {
        $refundAmount = [
            'value' => $value,
            'currency' => $currency,
        ];
        $this->refundAmount = $refundAmount;
        return $this;
    }

    public function setExternalStoreId($externalStoreId): RefundEwalletBuilder
    {
        $this->externalStoreId = $externalStoreId;
        return $this;
    }

    public function setReason($reason): RefundEwalletBuilder
    {
        $this->reason = $reason;
        return $this;
    }

    public function setAdditionalInfo($refundType): RefundEwalletBuilder
    {
        $additionalInfo = [
            'refundType' => $refundType,
        ];
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function build(): RefundEwallet
    {
        return new RefundEwallet($this);
    }
}
