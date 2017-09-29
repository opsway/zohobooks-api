<?php

namespace OpsWay\ZohoBooks\Api;

class Invoices extends BaseApi
{
    const API_PATH = 'invoices';
    const API_KEY = 'invoice';

    const STATUS_DRAFT = 'draft';
    const STATUS_SENT = 'sent';
    const STATUS_VIEWED = 'viewed';
    const STATUS_UNPAID = 'unpaid';
    const STATUS_PARTIALLY_PAID = 'partially_paid';
    const STATUS_PAID = 'paid';
    const STATUS_OVERDUE = 'overdue';
    const STATUS_VOID = 'void';

    const DISCOUNT_TYPE_ENTITY_LEVEL = 'entity_level';
    const DISCOUNT_TYPE_ITEM_LEVEL = 'item_level';

    const GATEWAY_NAME_PAYPAL = 'paypal';
    const GATEWAY_NAME_AUTHORIZE_NET = 'authorize_net';
    const GATEWAY_NAME_PAYFLOW_PRO = 'payflow_pro';
    const GATEWAY_NAME_STRIPE = 'stripe';
    const GATEWAY_NAME_2CHECKOUT = '2checkout';
    const GATEWAY_NAME_BRAINTREE = 'braintree';

    const ADDITIONAL_FIELD1_PAYPAL_PAYMENT_METHOD_STANDARD = 'standard';
    const ADDITIONAL_FIELD1_PAYPAL_PAYMENT_METHOD_ADAPTIVE = 'adaptive';

    const FILTER_BY_STATUS_ALL = 'Status.All';
    const FILTER_BY_STATUS_DRAFT = 'Status.Draft';
    const FILTER_BY_STATUS_SENT = 'Status.Sent';
    const FILTER_BY_STATUS_VIEWED = 'Status.Viewed';
    const FILTER_BY_STATUS_UNPAID = 'Status.Unpaid';
    const FILTER_BY_STATUS_PARTIALLY_PAID = 'Status.PartiallyPaid';
    const FILTER_BY_STATUS_PAID = 'Status.Paid';
    const FILTER_BY_STATUS_OVERDUE = 'Status.Overdue';
    const FILTER_BY_STATUS_VOID = 'Status.Void';
    const FILTER_BY_STATUS_PAYMENT_EXPECTED_DATE = 'Status.PaymentExpectedDate';

    const SORT_COLUMN_CUSTOMER_NAME = 'customer_name';
    const SORT_COLUMN_INVOICE_NUMBER = 'invoice_number';
    const SORT_COLUMN_DATE = 'date';
    const SORT_COLUMN_DUE_DATE = 'due_date';
    const SORT_COLUMN_TOTAL = 'total';
    const SORT_COLUMN_BALANCE = 'balance';
    const SORT_COLUMN_CREATED_TIME = 'created_time';

    const ACCEPT_JSON = 'json';
    const ACCEPT_HTML = 'html';
    const ACCEPT_PDF = 'pdf';

    public function applyCredits($invoiceId, $data)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/credits', $this->organizationId, $data);

        return true;
    }

    public function markAsSent($invoiceId)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/status/sent', $this->organizationId);

        return true;
    }

    public function markAsVoid($invoiceId)
    {
        $this->client->post(static::API_PATH.'/'.$invoiceId.'/status/void', $this->organizationId);

        return true;
    }

    /**
     * Email an invoice to the customer
     *
     * @see: https://www.zoho.com/books/api/v3/invoices/#email-an-invoice
     *
     * @param string $invoiceId
     * @param array $data
     *
     * @return bool
     */
    public function email($invoiceId, array $data)
    {
        if (!isset($data['to_mail_ids'])) {
            throw new \RuntimeException('Parameter `to_mail_ids` is required');
        }

        $this->client->post(static::API_PATH.'/'.$invoiceId.'/email', $this->organizationId, $data);

        return true;
    }
}
