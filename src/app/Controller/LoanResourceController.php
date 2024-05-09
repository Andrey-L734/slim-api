<?php

namespace App\Controller;

use App\Model\Loan;
use App\Model\Connection;
use App\Helper;

class LoanResourceController
{
    private static string $table = 'loans';

    public static function show(int $id): array|bool
    {
        $table = self::$table;

        $query = "SELECT * FROM `$table` WHERE `id` = :id";
        $stmt = Connection::getPdo()->prepare($query);
        $stmt->execute([
            'id' => $id
        ]);

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public static function showList(): array|bool
    {
        $table = self::$table;

        $query = "SELECT * FROM `$table`";
        $stmt = Connection::getPdo()->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public static function store(array $data): array
    {
        $loan = new Loan();
        $loan->setDataFromArray($data);
        $table = self::$table;

        $loan->setReturnDate(Helper::convertDate($data['returnDate']));

        $query = "INSERT INTO `$table` (`clientId`, `sum`, `receiptDate`, `returnDate`, `rate`) 
                  VALUES (:clientId, :sum, :receiptDate, :returnDate, :rate)";
        $stmt = Connection::getPdo()->prepare($query);
        $stmt->execute([
            'clientId' => $loan->getClientId(),
            'sum' => $loan->getSum(),
            'receiptDate' => $loan->getReceiptDate(),
            'returnDate' => $loan->getReturnDate(),
            'rate' => $loan->getRate(),
        ]);
        $loan->setId(Connection::getPdo()->lastInsertId());

        return $loan->getDataAsArray();
    }

    public static function update(array $data, int $id): array|bool
    {
        $loan = new Loan();
        $table = self::$table;

        $loan->setId($id);
        $loan->setDataFromArray($data);

        $loan->setReturnDate(Helper::convertDate($data['returnDate']));

        $query = "UPDATE `$table` SET `clientId`=:clientId,`sum`=:sum,`receiptDate`=:receiptDate,`returnDate`=:returnDate,`rate`=:rate 
                  WHERE `id` = :id";
        $stmt = Connection::getPdo()->prepare($query);
        $stmt->execute([
            'id' => $id,
            'clientId' => $loan->getClientId(),
            'sum' => $loan->getSum(),
            'receiptDate' => $loan->getReceiptDate(),
            'returnDate' => $loan->getReturnDate(),
            'rate' => $loan->getRate(),
        ]);

        return $loan->getDataAsArray();
    }

    public static function delete(int $id): bool
    {
        $loan = new Loan();
        $table = self::$table;
        $loan->setId($id);

        $query = "DELETE FROM `$table` WHERE `id` = :id";
        $stmt = Connection::getPdo()->prepare($query);
        return $stmt->execute([
            'id' => $id
        ]);
    }
}