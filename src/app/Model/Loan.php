<?php

namespace App\Model;

class Loan
{
    private ?int $id = null;
    private int $clientId;
    private int $sum;
    private string $receiptDate;
    private string $returnDate;
    private float $rate;

    public function setDataFromArray(array $data): void
    {
        $this->clientId = $data['clientId'];
        $this->sum = $data['sum'];
        $this->receiptDate = $data['receiptDate'] ?? date('Y-m-d H:i:s', time());
        $this->returnDate = $data['returnDate'];
        $this->rate = $data['rate'];
    }

    public function getDataAsArray(): array
    {
        return [
            'id' => $this->id,
            'clientId' => $this->clientId,
            'sum' => $this->sum,
            'receiptDate' => $this->receiptDate,
            'returnDate' => $this->returnDate,
            'rate' => $this->rate,
        ];
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return int
     */
    public function getClientId(): int
    {
        return $this->clientId;
    }

    /**
     * @param int $clientId
     */
    public function setClientId(int $clientId): void
    {
        $this->clientId = $clientId;
    }

    /**
     * @return int
     */
    public function getSum(): int
    {
        return $this->sum;
    }

    /**
     * @param int $sum
     */
    public function setSum(int $sum): void
    {
        $this->sum = $sum;
    }

    /**
     * @return string
     */
    public function getReceiptDate(): string
    {
        return $this->receiptDate;
    }

    /**
     * @param string $receiptDate
     */
    public function setReceiptDate(string $receiptDate): void
    {
        $this->receiptDate = $receiptDate;
    }

    /**
     * @return string
     */
    public function getReturnDate(): string
    {
        return $this->returnDate;
    }

    /**
     * @param string $returnDate
     */
    public function setReturnDate(string $returnDate): void
    {
        $this->returnDate = $returnDate;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @param int $rate
     */
    public function setRate(int $rate): void
    {
        $this->rate = $rate;
    }
}