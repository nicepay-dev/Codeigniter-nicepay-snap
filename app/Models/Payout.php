<?php

namespace App\Models;

class Payout
{

    // SNAP 

    private $merchantId;
    private $beneficiaryAccountNo;
    private $beneficiaryName;
    private $beneficiaryPhone;
    private $beneficiaryCustomerResidence;
    private $beneficiaryCustomerType;
    private $beneficiaryPostalCode;
    private $payoutMethod;
    private $beneficiaryBankCode;
    private array $amount;
    private $partnerReferenceNo;
    private $description;
    private $deliveryName;
    private $deliveryId;
    private $reservedDt;
    private $reservedTm;
    private $originalReferenceNo;
    private $originalPartnerReferenceNo;
    private $accountNo;
    private $additionalInfo;

    function __construct(PayoutBuilder $builder)
    {
        // SNAP

        $this->merchantId = $builder->getMerchantId();
        $this->beneficiaryAccountNo = $builder->getBeneficiaryAccountNo();
        $this->beneficiaryName = $builder->getBeneficiaryName();
        $this->beneficiaryPhone = $builder->getBeneficiaryPhone();
        $this->beneficiaryCustomerResidence = $builder->getBeneficiaryCustomerResidence();
        $this->beneficiaryCustomerType = $builder->getBeneficiaryCustomerType();
        $this->beneficiaryPostalCode = $builder->getBeneficiaryPostalCode();
        $this->payoutMethod = $builder->getPayoutMethod();
        $this->beneficiaryBankCode = $builder->getBeneficiaryBankCode();
        $this->amount = $builder->getAmount();
        $this->partnerReferenceNo = $builder->getPartnerReferenceNo();
        $this->description = $builder->getDescription();
        $this->deliveryName = $builder->getDeliveryName();
        $this->deliveryId = $builder->getDeliveryId();
        $this->reservedDt = $builder->getReservedDt();
        $this->reservedTm = $builder->getReservedTm();
        $this->originalReferenceNo = $builder->getOriginalReferenceNo();
        $this->originalPartnerReferenceNo = $builder->getOriginalPartnerReferenceNo();
        $this->accountNo = $builder->getAccountNo();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    public static function builder(): PayoutBuilder
    {
        return new PayoutBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            "merchantId" => $this->merchantId ?? null,
            "beneficiaryAccountNo" => $this->beneficiaryAccountNo ?? null,
            "beneficiaryName" => $this->beneficiaryName ?? null,
            "beneficiaryPhone" => $this->beneficiaryPhone ?? null,
            "beneficiaryCustomerResidence" => $this->beneficiaryCustomerResidence ?? null,
            "beneficiaryCustomerType" => $this->beneficiaryCustomerType ?? null,
            "beneficiaryPostalCode" => $this->beneficiaryPostalCode ?? null,
            "payoutMethod" => $this->payoutMethod ?? null,
            "beneficiaryBankCode" => $this->beneficiaryBankCode ?? null,
            "amount" => $this->amount ?? [],
            "partnerReferenceNo" => $this->partnerReferenceNo ?? null,
            "description" => $this->description ?? null,
            "deliveryName" => $this->deliveryName ?? null,
            "deliveryId" => $this->deliveryId ?? null,
            "reservedDt" => $this->reservedDt ?? null,
            "reservedTm" => $this->reservedTm ?? null,
            "originalReferenceNo" => $this->originalReferenceNo ?? null,
            "originalPartnerReferenceNo" => $this->originalPartnerReferenceNo ?? null,
            "accountNo" => $this->accountNo ?? null,
            "additionalInfo" => $this->additionalInfo ?? null,
        ];
    }
}

class PayoutBuilder
{

    // SNAP

    private $merchantId;
    private $beneficiaryAccountNo;
    private $beneficiaryName;
    private $beneficiaryPhone;
    private $beneficiaryCustomerResidence;
    private $beneficiaryCustomerType;
    private $beneficiaryPostalCode;
    private $payoutMethod;
    private $beneficiaryBankCode;
    private array $amount = [];
    private $partnerReferenceNo;
    private $description;
    private $deliveryName;
    private $deliveryId;
    private $reservedDt;
    private $reservedTm;
    private $originalReferenceNo;
    private $originalPartnerReferenceNo;
    private $accountNo;
    private $additionalInfo;

    // GETTER SNAP

    public function getMerchantId(): mixed
    {
        return $this->merchantId;
    }

    public function getBeneficiaryAccountNo(): mixed
    {
        return $this->beneficiaryAccountNo;
    }

    public function getBeneficiaryName(): mixed
    {
        return $this->beneficiaryName;
    }

    public function getBeneficiaryPhone(): mixed
    {
        return $this->beneficiaryPhone;
    }

    public function getBeneficiaryCustomerResidence(): mixed
    {
        return $this->beneficiaryCustomerResidence;
    }

    public function getBeneficiaryCustomerType(): mixed
    {
        return $this->beneficiaryCustomerType;
    }

    public function getBeneficiaryPostalCode(): mixed
    {
        return $this->beneficiaryPostalCode;
    }

    public function getPayoutMethod(): mixed
    {
        return $this->payoutMethod;
    }

    public function getBeneficiaryBankCode(): mixed
    {
        return $this->beneficiaryBankCode;
    }

    public function getAmount(): array
    {
        return $this->amount;
    }

    public function getPartnerReferenceNo(): mixed
    {
        return $this->partnerReferenceNo;
    }

    public function getDescription(): mixed
    {
        return $this->description;
    }

    public function getDeliveryName(): mixed
    {
        return $this->deliveryName;
    }

    public function getDeliveryId(): mixed
    {
        return $this->deliveryId;
    }

    public function getReservedDt(): mixed
    {
        return $this->reservedDt;
    }

    public function getReservedTm(): mixed
    {
        return $this->reservedTm;
    }

    public function getOriginalReferenceNo(): mixed
    {
        return $this->originalReferenceNo;
    }

    public function getOriginalPartnerReferenceNo()
    {
        return $this->originalPartnerReferenceNo;
    }

    public function getAccountNo(): mixed
    {
        return $this->accountNo;
    }

    public function getAdditionalInfo(): mixed
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setMerchantId($merchantId): PayoutBuilder
    {
        $this->merchantId = $merchantId;
        return $this;
    }

    public function setBeneficiaryAccountNo($beneficiaryAccountNo): PayoutBuilder
    {
        $this->beneficiaryAccountNo = $beneficiaryAccountNo;
        return $this;
    }

    public function setBeneficiaryName($beneficiaryName): PayoutBuilder
    {
        $this->beneficiaryName = $beneficiaryName;
        return $this;
    }

    public function setBeneficiaryPhone($beneficiaryPhone): PayoutBuilder
    {
        $this->beneficiaryPhone = $beneficiaryPhone;
        return $this;
    }

    public function setBeneficiaryCustomerResidence($beneficiaryCustomerResidence): PayoutBuilder
    {
        $this->beneficiaryCustomerResidence = $beneficiaryCustomerResidence;
        return $this;
    }

    public function setBeneficiaryCustomerType($beneficiaryCustomerType): PayoutBuilder
    {
        $this->beneficiaryCustomerType = $beneficiaryCustomerType;
        return $this;
    }

    public function setBeneficiaryPostalCode($beneficiaryPostalCode): PayoutBuilder
    {
        $this->beneficiaryPostalCode = $beneficiaryPostalCode;
        return $this;
    }

    public function setPayoutMethod($payoutMethod): PayoutBuilder
    {
        $this->payoutMethod = $payoutMethod;
        return $this;
    }

    public function setBeneficiaryBankCode($beneficiaryBankCode): PayoutBuilder
    {
        $this->beneficiaryBankCode = $beneficiaryBankCode;
        return $this;
    }

    public function setAmount($value, $currency): PayoutBuilder
    {
        $amount = [
            "value" => $value,
            "currency" => $currency,
        ];
        $this->amount = $amount;
        return $this;
    }

    public function setPartnerReferenceNo($partnerReferenceNo): PayoutBuilder
    {
        $this->partnerReferenceNo = $partnerReferenceNo;
        return $this;
    }

    public function setDescription($description): PayoutBuilder
    {
        $this->description = $description;
        return $this;
    }

    public function setDeliveryName($deliveryName): PayoutBuilder
    {
        $this->deliveryName = $deliveryName;
        return $this;
    }

    public function setDeliveryId($deliveryId): PayoutBuilder
    {
        $this->deliveryId = $deliveryId;
        return $this;
    }

    public function setReservedDt($reservedDt): PayoutBuilder
    {
        $this->reservedDt = $reservedDt;
        return $this;
    }

    public function setReservedTm($reservedTm): PayoutBuilder
    {
        $this->reservedTm = $reservedTm;
        return $this;
    }

    public function setOriginalReferenceNo($originalReferenceNo): PayoutBuilder
    {
        $this->originalReferenceNo = $originalReferenceNo;
        return $this;
    }

    public function setOriginalPartnerReferenceNo($originalPartnerReferenceNo): PayoutBuilder
    {
        $this->originalPartnerReferenceNo = $originalPartnerReferenceNo;
        return $this;
    }

    public function setAccountNo($accountNo): PayoutBuilder
    {
        $this->accountNo = $accountNo;
        return $this;
    }

    public function setAdditionalInfo($additionalInfo): PayoutBuilder
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function build(): Payout
    {
        return new Payout($this);
    }
}
