<?php

namespace App\Models;

class DeleteVirtualAccount
{

    // SNAP 

    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $trxId;
    private array $additionalInfo; // totalAmount, tXidVA, cancelMessage

    function __construct(DeleteVirtualAccountBuilder $builder)
    {
        // SNAP

        $this->partnerServiceId = $builder->getPartnerServiceId();
        $this->customerNo = $builder->getCustomerNo();
        $this->virtualAccountNo = $builder->getVirtualAccountNo();
        $this->trxId = $builder->getTrxId();
        $this->additionalInfo = $builder->getAdditionalInfo();

    }

    public static function builder(): DeleteVirtualAccountBuilder
    {
        return new DeleteVirtualAccountBuilder();
    }

    // SNAP

    public function toArray(): array
    {
        return [
            'partnerServiceId' => $this->partnerServiceId,
            'customerNo' => $this->customerNo,
            'virtualAccountNo' => $this->virtualAccountNo,
            'trxId' => $this->trxId,
            'additionalInfo' => $this->additionalInfo,
        ];
    }
}

class DeleteVirtualAccountBuilder
{

    // SNAP

    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $trxId;
    private array $additionalInfo = [];

    // GETTER SNAP

    public function getPartnerServiceId(): string
    {
        return $this->partnerServiceId;
    }

    public function getCustomerNo(): string
    {
        return $this->customerNo;
    }

    public function getVirtualAccountNo(): string
    {
        return $this->virtualAccountNo;
    }

    public function getTrxId()
    {
        return $this->trxId;
    }

    public function getAdditionalInfo()
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setPartnerServiceId(string $partnerServiceId): DeleteVirtualAccountBuilder
    {
        $this->partnerServiceId = $partnerServiceId;
        return $this;
    }

    public function setCustomerNo(string $customerNo): DeleteVirtualAccountBuilder
    {
        $this->customerNo = $customerNo;
        return $this;
    }

    public function setVirtualAccountNo(string $virtualAccountNo): DeleteVirtualAccountBuilder
    {
        $this->virtualAccountNo = $virtualAccountNo;
        return $this;
    }

    public function setTrxId(string $trxId): DeleteVirtualAccountBuilder
    {
        $this->trxId = $trxId;
        return $this;
    }

    public function setTotalAmount($value, $currency): DeleteVirtualAccountBuilder
    {
        $this->additionalInfo["totalAmount"] = [
            "value" => $value,
            "currency" => $currency,
        ];
        return $this;
    }

    public function setTxIdVA($txIdVA): DeleteVirtualAccountBuilder
    {
        $this->additionalInfo["tXidVA"] = $txIdVA;
        return $this;
    }

    public function setCancelMessage($cancelMessage): DeleteVirtualAccountBuilder
    {
        $this->additionalInfo["cancelMessage"] = $cancelMessage;
        return $this;
    }

    public function build(): DeleteVirtualAccount
    {
        return new DeleteVirtualAccount($this);
    }
}
