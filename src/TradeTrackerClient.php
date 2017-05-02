<?php

namespace whitelabeled\TradeTrackerApi;

use DateTime;
use Httpful\Request;
use SoapClient;

class TradeTrackerClient {
    /**
     * @var string Organization ID
     */
    private $organizationId;

    /**
     * @var string Token for reporting API
     */
    private $token;

    /**
     * @var string Currency ID
     */
    public $currency = 'EUR';

    /**
     * @var string API Endpoint
     */
    protected $wsdl = 'http://ws.tradetracker.com/soap/affiliate?wsdl';

    /**
     * TradeTracker API client constructor.
     * @param $customerId     string Customer ID
     * @param $token          string Token
     */
    public function __construct($customerId, $token) {
        $this->customerId = $customerId;
        $this->token = $token;
    }

    /**
     * Get all transactions from $startDate until $endDate.
     *
     * @param DateTime      $startDate Start date
     * @param DateTime|null $endDate   End date, optional (defaults to today)
     * @return array Transaction objects. Each part of a transaction is returned as a separate Transaction.
     */
    public function getTransactions(DateTime $startDate, DateTime $endDate = null) {
        if ($endDate == null) {
            $endDate = new DateTime();
        }

        $client = $this->getSoapClient();

        // Get site ID's:
        $sites = $client->getAffiliateSites();

        $transactions = [];

        $options = array(
            'registrationDateFrom' => $startDate->format('Y-m-d 00:00:00'),
            'registrationDateTo'   => $endDate->format('Y-m-d 23:59:59'),
        );

        foreach ($sites as $site) {
            foreach ($client->getConversionTransactions($site->ID, $options) as $sale) {
                $transactions[] = Transaction::createFromObject($site, $sale);
            }
        }

        return $transactions;
    }

    protected function getSoapClient() {
        $client = new SoapClient($this->wsdl, array('compression' => SOAP_COMPRESSION_ACCEPT | SOAP_COMPRESSION_GZIP));
        $client->authenticate($this->customerId, $this->token);

        return $client;
    }
}
