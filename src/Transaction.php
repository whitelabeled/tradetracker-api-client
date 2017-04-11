<?php

namespace whitelabeled\TradeTrackerApi;

use DateTime;

class Transaction {
    /**
     * @var string
     */
    public $id;

    /**
     * @var DateTime
     */
    public $transactionDate;

    /**
     * @var DateTime
     */
    public $clickDate;

    /**
     * @var DateTime
     */
    public $assessmentDate;

    /**
     * @var string
     */
    public $program;

    /**
     * @var string
     */
    public $programId;

    /**
     * @var string
     */
    public $status;

    /**
     * @var string
     */
    public $rejectionReason;

    /**
     * @var string
     */
    public $reference;

    /**
     * @var double
     */
    public $commission;

    /**
     * @var double
     */
    public $orderValue;

    /**
     * @var string
     */
    public $orderDescription;

    /**
     * @var int
     */
    public $mediaId;

    /**
     * @var string
     */
    public $mediaName;

    /**
     * @var bool
     */
    public $paidOut = false;

    /**
     * @var string
     */
    public $transactionType;

    /**
     * Create a Transaction object from two JSON objects
     * @param $site      \stdClass Site data
     * @param $transData \stdClass Transaction data
     * @return Transaction
     */
    public static function createFromObject($site, $transData) {
        $transaction = new Transaction();

        $transaction->id = $transData->ID;
        $transaction->program = $transData->campaign->name;
        $transaction->programId = $transData->campaign->ID;

        $transaction->transactionType = $transData->transactionType;
        $transaction->commission = doubleval($transData->commission);
        $transaction->orderValue = doubleval($transData->orderAmount);
        $transaction->orderDescription = $transData->description;
        $transaction->reference = $transData->reference;

        $transaction->mediaId = $site->ID;
        $transaction->mediaName = $site->name;

        $transaction->clickDate = self::parseDate($transData->originatingClickDate);
        $transaction->transactionDate = self::parseDate($transData->registrationDate);
        $transaction->assessmentDate = self::parseDate($transData->assessmentDate);

        $transaction->status = $transData->transactionStatus;
        $transaction->rejectionReason = $transData->rejectionReason;
        $transaction->paidOut = $transData->paidOut;

        return $transaction;
    }

    /**
     * Parse a date
     * @param $date string Date/time string
     * @return DateTime|null
     */
    private static function parseDate($date) {
        if ($date == null) {
            return null;
        } else {
            return new \DateTime($date);
        }
    }
}
