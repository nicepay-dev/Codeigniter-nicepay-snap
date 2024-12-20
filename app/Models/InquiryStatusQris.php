<?php

namespace App\Models;

class InquiryStatusQris
{

    // SNAP 

    // Virtual Account
    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $inquiryRequestId;
    private array $additionalInfo; // totalAmount, tXidVA, trxId

    // Ewallet
    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;

    private $serviceCode;
    private $transactionDate;
    private $externalStoreId;
    private array $amount;

    // PAYOUT
    private $beneficiaryAccountNo;

    function __construct(InquiryStatusQrisBuilder $builder)
    {
        // SNAP

        $this->partnerServiceId = $builder->getPartnerServiceId();
        $this->customerNo = $builder->getCustomerNo();
        $this->virtualAccountNo = $builder->getVirtualAccountNo();
        $this->additionalInfo = $builder->getAdditionalInfo();
        $this->inquiryRequestId = $builder->getInquiryRequestId();

        // EWALLET 
        $this->merchantId = $builder->getMerchantId();
        $this->subMerchantId = $builder->getSubMerchantId();
        $this->originalPartnerReferenceNo = $builder->getOriginalPartnerReferenceNo();
        $this->originalReferenceNo = $builder->getOriginalReferenceNo();
        $this->serviceCode = $builder->getServiceCode();
        $this->transactionDate = $builder->getTransactionDate();
        $this->externalStoreId = $builder->getExternalStoreId();
        $this->amount = $builder->getAmount();

        // PAYOUT
        $this->beneficiaryAccountNo = $builder->getBeneficiaryAccountNo();
    }

    public static function builder(): InquiryStatusQrisBuilder
    {
        return new InquiryStatusQrisBuilder();
    }

    // SNAP

    public function toArray(): array
    {
        return [
            'partnerServiceId' => $this->partnerServiceId,
            'customerNo' => $this->customerNo,
            'virtualAccountNo' => $this->virtualAccountNo,
            'inquiryRequestId' => $this->inquiryRequestId,
            // 'additionalInfo' => $this->additionalInfo,
            'additionalInfo' => empty($this->additionalInfo) ? (object) [] : $this->additionalInfo,
            'merchantId' => $this->merchantId,
            'subMerchantId' => $this->subMerchantId,
            'originalPartnerReferenceNo' => $this->originalPartnerReferenceNo,
            'originalReferenceNo' => $this->originalReferenceNo,
            'serviceCode' => $this->serviceCode,
            'transactionDate' => $this->transactionDate,
            'externalStoreId' => $this->externalStoreId,
            'amount' => $this->amount,
            'beneficiaryAccountNo' => $this->beneficiaryAccountNo,
        ];
    }
}

class InquiryStatusQrisBuilder
{

    // SNAP

    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $inquiryRequestId;
    private array $additionalInfo = [];
    // private $additionalInfo;

    // EWALLET
    private $merchantId;
    private $subMerchantId;
    private $originalPartnerReferenceNo;
    private $originalReferenceNo;
    private $serviceCode;
    private $transactionDate;
    private $externalStoreId;
    private array $amount = [];

    // PAYOUT
    private $beneficiaryAccountNo;

    // GETTER SNAP

    public function getPartnerServiceId(): mixed
    {
        return $this->partnerServiceId;
    }

    public function getCustomerNo(): mixed
    {
        return $this->customerNo;
    }

    public function getVirtualAccountNo(): mixed
    {
        return $this->virtualAccountNo;
    }

    public function getInquiryRequestId(): mixed
    {
        return $this->inquiryRequestId;
    }

    public function getAdditionalInfo(): mixed
    {
        return $this->additionalInfo;
    }

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

    public function getAmount()
    {
        return $this->amount;
    }

    public function getBeneficiaryAccountNo()
    {
        return $this->beneficiaryAccountNo;
    }

    // SETTER SNAP

    public function setPartnerServiceId(string $partnerServiceId): InquiryStatusQrisBuilder
    {
        $this->partnerServiceId = $partnerServiceId;
        return $this;
    }

    public function setCustomerNo(string $customerNo): InquiryStatusQrisBuilder
    {
        $this->customerNo = $customerNo;
        return $this;
    }

    public function setVirtualAccountNo(string $virtualAccountNo): InquiryStatusQrisBuilder
    {
        $this->virtualAccountNo = $virtualAccountNo;
        return $this;
    }

    public function setInquiryRequestId(string $inquiryRequestId): InquiryStatusQrisBuilder
    {
        $this->inquiryRequestId = $inquiryRequestId;
        return $this;
    }

    public function setTotalAmount($value, $currency): InquiryStatusQrisBuilder
    {
        $this->additionalInfo["totalAmount"] = [
            "value" => $value,
            "currency" => $currency,
        ];
        return $this;
    }

    public function setTrxId($trxId): InquiryStatusQrisBuilder
    {
        $this->additionalInfo["trxId"] = $trxId;
        return $this;
    }

    public function setTxIdVA($txIdVA): InquiryStatusQrisBuilder
    {
        $this->additionalInfo["tXidVA"] = $txIdVA;
        return $this;
    }

    public function setMerchantId($merchantId): InquiryStatusQrisBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setSubMerchantId($subMerchantId)
    {
        $this->subMerchantId = $subMerchantId;
        return $this;
    }

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo)
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo)
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
        return $this;
    }

    public function setTransactionDate($transactionDate)
    {
        $this->transactionDate = $transactionDate;
        return $this;
    }

    public function setExternalStoreId($externalStoreId)
    {
        $this->externalStoreId = $externalStoreId;
        return $this;
    }

    public function setAmount($value, $currency)
    {
        $amount = [
            "value" => $value,
            "currency" => $currency,
        ];
        $this->amount = $amount;
        return $this;
    }

    public function setAdditionalInfo($additionalInfo): InquiryStatusQrisBuilder
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function setBeneficiaryAccountNo($beneficiaryAccountNo): InquiryStatusQrisBuilder
    {
        $this->beneficiaryAccountNo = $beneficiaryAccountNo;
        return $this;
    }

    public function build(): InquiryStatusQris
    {
        return new InquiryStatusQris($this);
    }
}
