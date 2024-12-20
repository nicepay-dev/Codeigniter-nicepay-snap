<?php

namespace App\Models;

class VirtualAccount
{

    // SNAP 

    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $virtualAccountName;
    private $trxId;
    private array $totalAmount;
    private array $additionalInfo;

    function __construct(VirtualAccountBuilder $builder)
    {
        // SNAP

        $this->partnerServiceId = $builder->getPartnerServiceId();
        $this->customerNo = $builder->getCustomerNo();
        $this->virtualAccountNo = $builder->getVirtualAccountNo();
        $this->virtualAccountName = $builder->getVirtualAccountName();
        $this->trxId = $builder->getTrxId();
        $this->totalAmount = $builder->getTotalAmount();
        $this->additionalInfo = $builder->getAdditionalInfo();
    }

    // GETTER SNAP

    public function getPartnerId(): string{
        return $this->partnerServiceId;
    }
    public function getCustomerNo(): string{
        return $this->customerNo;
    }
    public function getVirtualAccountNo(): string{
        return $this->virtualAccountNo;
    }
    public function getVirtualAccountName(): string{
        return $this->virtualAccountName;
    }
    public function getTrxId(): string{
        return $this->trxId;
    }
    public function getTotalAmount(): array{
        return $this->totalAmount;
    }
    public function getAdditionalInfo(): array{
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setPartnerId(string $partnerId): void{
        $this->partnerServiceId = $partnerId;
    }
    public function setCustomerNo(string $customerNo): void{
        $this->customerNo = $customerNo;
    }
    public function setVirtualAccountNo(string $virtualAccountNo): void{
        $this->virtualAccountNo = $virtualAccountNo;
    }
    public function setVirtualAccountName(string $virtualAccountName): void{
        $this->virtualAccountName = $virtualAccountName;
    }
    public function setTrxId(string $trxId): void{
        $this->trxId = $trxId;
    }
    public function setTotalAmount(array $totalAmount): void{
        $this->totalAmount = $totalAmount;
    }
    public function setAdditionalInfo(array $additionalInfo): void{
        $this->additionalInfo = $additionalInfo;
    }
    
    public static function builder(): VirtualAccountBuilder {
        return new VirtualAccountBuilder();
    }

    // SNAP

    public function toArray(): array
    {

        return [
            'customerNo' => $this->customerNo,
            'virtualAccountNo' => $this->virtualAccountNo,
            'virtualAccountName' => $this->virtualAccountName,
            'trxId' => $this->trxId,
            'totalAmount' => $this->totalAmount,
            'additionalInfo' => $this->additionalInfo,
            'partnerServiceId' => $this->partnerServiceId,
        ];
    }
}

class VirtualAccountBuilder
{

    // SNAP

    private $partnerServiceId;
    private $customerNo;
    private $virtualAccountNo;
    private $virtualAccountName;
    private $trxId;
    private $totalAmount = [];
    private $additionalInfo = [];

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
    public function getVirtualAccountName(): string
    {
        return $this->virtualAccountName;
    }
    public function getTrxId(): string
    {
        return $this->trxId;
    }
    public function getTotalAmount(): array
    {
        return $this->totalAmount;
    }
    public function getAdditionalInfo(): array
    {
        return $this->additionalInfo;
    }

    // SETTER SNAP

    public function setPartnerServiceId(string $partnerServiceId): VirtualAccountBuilder
    {
        $this->partnerServiceId = $partnerServiceId;
        return $this;
    }
    public function setCustomerNo(string $customerNo): VirtualAccountBuilder
    {
        $this->customerNo = $customerNo;
        return $this;
    }
    public function setVirtualAccountNo(string $virtualAccountNo): VirtualAccountBuilder
    {
        $this->virtualAccountNo = $virtualAccountNo;
        return $this;
    }
    public function setVirtualAccountName(string $virtualAccountName): VirtualAccountBuilder
    {
        $this->virtualAccountName = $virtualAccountName;
        return $this;
    }
    public function setTrxId(string $trxId): VirtualAccountBuilder
    {
        $this->trxId = $trxId;
        return $this;
    }
    public function setTotalAmount($value, $currency): VirtualAccountBuilder
    {
        $this->totalAmount = [
            "value" => $value,
            "currency" => $currency
        ];
        return $this;
    }
    public function setAdditionalInfo(array $additionalInfo): VirtualAccountBuilder
    {
        $this->additionalInfo = $additionalInfo;
        return $this;
    }

    public function build(): VirtualAccount
    {
        return new VirtualAccount($this);
    }
}
