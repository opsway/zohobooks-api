<?php

namespace OpsWay\ZohoBooks\Api;

class Contacts extends BaseApi
{
    const API_PATH = 'contacts';
    const API_KEY = 'contact';

    const FILTER_BY_STATUS_ALL = 'Status.All';
    const FILTER_BY_STATUS_ACTIVE = 'Status.Active';
    const FILTER_BY_STATUS_INACTIVE = 'Status.Inactive';
    const FILTER_BY_STATUS_DUPLICATE = 'Status.Duplicate';
    const FILTER_BY_STATUS_CUSTOMERS = 'Status.Customers';
    const FILTER_BY_STATUS_VENDORS = 'Status.Vendors';
    const FILTER_BY_STATUS_CRM = 'Status.Crm';

    const SORT_COLUMN_CONTACT_NAME = 'contact_name';
    const SORT_COLUMN_FIRST_NAME = 'first_name';
    const SORT_COLUMN_LAST_NAME = 'last_name';
    const SORT_COLUMN_EMAIL = 'email';
    const SORT_COLUMN_OUTSTANDING_RECEIVABLE_AMOUNT = 'outstanding_receivable_amount';
    const SORT_COLUMN_OUTSTANDING_PAYABLE_AMOUNT = 'outstanding_payable_amount';
    const SORT_COLUMN_CREATED_TIME = 'created_time';
    const SORT_COLUMN_LAST_MODIFIED_TIME = 'last_modified_time';

    const VAT_TREATMENT_UK = 'uk';
    const VAT_TREATMENT_EU_REGISTERED = 'eu_vat_registered';
    const VAT_TREATMENT_EU_NOT_REGISTERED = 'eu_vat_not_registered';
    const VAT_TREATMENT_NON_EU = 'non_eu';
}
