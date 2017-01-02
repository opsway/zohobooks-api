<?php

namespace OpsWay\ZohoBooks;

class Api
{
    protected $authToken;
    protected $email;
    protected $password;
    /**
     * @var Client
     */
    protected $client;
    protected $organizationId;

    /**
     * Api constructor.
     *
     * @param      $emailOrToken
     * @param null $password
     */
    public function __construct($emailOrToken, $password = null)
    {
        if (null === $password) {
            $this->authToken = $emailOrToken;
        } else {
            $this->email = $emailOrToken;
            $this->password = $password;
        }
    }

    /**
     * @return Client
     */
    public function getClient()
    {
        if (null ===  $this->client) {
            $this->setClient(new Client($this->authToken, $this->email, $this->password));
        }

        return $this->client;
    }

    public function getOrganizationId()
    {
        return $this->organizationId;
    }

    /**
     * @param Client $client
     *
     * @return Api
     */
    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * @param mixed $organizationId
     *
     * @return Api
     */
    public function setOrganizationId($organizationId)
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    public function contacts($organizationId = null)
    {
        return new Api\Contacts($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function estimates($organizationId = null)
    {
        return new Api\Estimates($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function bills($organizationId = null)
    {
        return new Api\Bills($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function bankAccounts($organizationId = null)
    {
        return new Api\BankAccounts($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function bankRules($organizationId = null)
    {
        return new Api\BankRules($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function bankTransactions($organizationId = null)
    {
        return new Api\BankTransactions($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function baseCurrencyAdjustment($organizationId = null)
    {
        return new Api\BaseCurrencyAdjustment($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function chartOfAccounts($organizationId = null)
    {
        return new Api\ChartOfAccounts($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function creditNotes($organizationId = null)
    {
        return new Api\CreditNotes($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function customerPayments($organizationId = null)
    {
        return new Api\CustomerPayments($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function expenses($organizationId = null)
    {
        return new Api\Expenses($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function invoices($organizationId = null)
    {
        return new Api\Invoices($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function journals($organizationId = null)
    {
        return new Api\Journals($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function projects($organizationId = null)
    {
        return new Api\Projects($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function purchaseOrder($organizationId = null)
    {
        return new Api\PurchaseOrder($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function recurringExpenses($organizationId = null)
    {
        return new Api\RecurringExpenses($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function recurringInvoices($organizationId = null)
    {
        return new Api\RecurringInvoices($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function salesOrder($organizationId = null)
    {
        return new Api\SalesOrder($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function settings($organizationId = null)
    {
        return new Api\Settings($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function vendorCredits($organizationId = null)
    {
        return new Api\VendorCredits($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }

    public function vendorPayments($organizationId = null)
    {
        return new Api\VendorPayments($this->getClient(), $organizationId ?: $this->getOrganizationId());
    }
}
