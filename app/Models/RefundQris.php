<?php

namespace App\Models;

class RefundQris
{

    // SNAP 

    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $partnerRefundNo;
    private $merchantId;
    private $externalStoreId;
    private array $refundAmount;
    private $reason;
    private array $additionalInfo;

    function __construct(RefundQrisBuilder $builder)
    {
        // SNAP

        $this->originalPartnerReferenceNo = $builder->getOriginalPartnerReferenceNo();
        $this->originalReferenceNo = $builder->getOriginalReferenceNo();
        $this->partnerRefundNo = $builder->getPartnerRefundNo();
        $this->merchantId = $builder->getMerchantId();
        $this->externalStoreId = $builder->getExternalStoreId();
        $this->refundAmount = $builder->getRefundAmount();
        $this->reason = $builder->getReason();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    public static function builder(): RefundQrisBuilder
    {
        return new RefundQrisBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            "originalPartnerReferenceNo" => $this->originalPartnerReferenceNo,
            "originalReferenceNo" => $this->originalReferenceNo,
            "partnerRefundNo" => $this->partnerRefundNo,
            "merchantId" => $this->merchantId,
            "externalStoreId" => $this->externalStoreId,
            "refundAmount" => $this->refundAmount,
            "reason" => $this->reason,
            "additionalInfo" => $this->additionalInfo,
        ];
    }
}

class RefundQrisBuilder
{

    // SNAP

    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $partnerRefundNo;
    private $merchantId;
    private $externalStoreId;
    private array $refundAmount = [];
    private $reason;
    private array $additionalInfo = [];

    // GETTER SNAP

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

    public function getMerchantId()
    {
        return $this->merchantId;
    }

    public function getExternalStoreId()
    {
        return $this->externalStoreId;
    }

    public function getRefundAmount(): array
    {
        return $this->refundAmount;
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

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo): RefundQrisBuilder
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo): RefundQrisBuilder
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setPartnerRefundNo($partnerRefundNo): RefundQrisBuilder
    {
        $this->partnerRefundNo = $partnerRefundNo;
        return $this;
    }

    public function setMerchantId($merchantId): RefundQrisBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setExternalStoreId($externalStoreId): RefundQrisBuilder
    {
        $this->externalStoreId = $externalStoreId;
        return $this;
    }

    public function setRefundAmount($value, $currency): RefundQrisBuilder
    {
        $refundAmount = [
            'value' => $value,
            'currency' => $currency,
        ];
        $this->refundAmount = $refundAmount;
        return $this;
    }

    public function setReason($reason): RefundQrisBuilder
    {
        $this->reason = $reason;
        return $this;
    }

    public function setAdditionalInfo($cancelType): RefundQrisBuilder
    {
        $additionalInfo = [
            'cancelType' => $cancelType,
        ];
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function build(): RefundQris
    {
        return new RefundQris($this);
    }
}
