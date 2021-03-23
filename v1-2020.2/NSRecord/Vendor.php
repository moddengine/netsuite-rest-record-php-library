<?php
class NSRecord_Vendor extends RequestAbstract
{
   /**
    * [vendor]
    * This record is available as a beta record.
    *
    * @var array
    */
    public static $schema = [
        'accountNumber',           // string
        'achAcct',                 // VendorAchAcctCollection
        'addressBook',             // VendorAddressBookCollection
        'altEmail',                // string
        'altName',                 // string
        'altPhone',                // string
        'autoName',                // bool
        'balance',                 // float
        'balancePrimary',          // float
        'bcn',                     // string
        'billingClass',            // BillingClass
        'bulkMerge',               // VendorBulkMergeCollection
        'campaigns',               // VendorCampaignsCollection
        'category',                // VendorCategory
        'comments',                // string
        'companyName',             // string
        'contact',                 // Contact
        'contactList',             // ContactCollection
        'creditLimit',             // float
        'currency',                // Currency
        'currencylist',            // VendorCurrencylistCollection
        'customForm',              // string enum(-10916, -10915, -10914, -20961, -10230, -893, -892, -410, -891, -770)
        'dateCreated',             // string
        'defaultAddress',          // string
        'defaultBankAccount',      // Account
        'defaultBillingAddress',   // string
        'defaultShippingAddress',  // string
        'defaultTaxReg',           // string
        'defaultTaxRegOptions',    // string
        'edition',                 // string enum(XX, AU, UK, JP, US, CA)
        'eligibleForCommission',   // bool
        'email',                   // string
        'emailPreference',         // string enum(PDF, HTML, DEFAULT)
        'emailTransactions',       // bool
        'emailVal',                // string
        'entityId',                // string
        'entityNumber',            // int
        'entityTitle',             // string
        'expenseAccount',          // Account
        'externalId',              // string
        'fax',                     // string
        'faxTransactions',         // bool
        'firstName',               // string
        'giveAccess',              // bool
        'globalSubscriptionStatus',// string enum(1, 2, 3, 4)
        'glommedName',             // string
        'hasShippingAddress',      // bool
        'homePhone',               // string
        'id',                      // string
        'image',                   // NsResource
        'incoterm',                // NsResource
        'intransitbalance',        // float
        'is1099Eligible',          // bool
        'isInactive',              // bool
        'isIndividual',            // bool
        'isJobResourceVend',       // bool
        'isPerson',                // bool
        'isTaxAgency',             // bool
        'isautogeneratedrepresentingentity',// bool
        'laborCost',               // float
        'lastModifiedDate',        // string
        'lastName',                // string
        'legalName',               // string
        'links',                   // NsLink, [read_only]
        'manufacturingLocations',  // LocationCollection
        'middleName',              // string
        'mobilePhone',             // string
        'openingbalance',          // float
        'openingbalanceaccount',   // Account
        'openingbalancedate',      // string
        'payablesAccount',         // Account
        'phone',                   // string
        'phoneticName',            // string
        'predConfidence',          // float
        'predictedDays',           // int
        'prepaymentbalance',       // float
        'printOnCheckAs',          // string
        'printTransactions',       // bool
        'purchaseOrderAmount',     // float
        'purchaseOrderQuantity',   // float
        'purchaseOrderQuantityDiff',// float
        'rate',                    // float
        'rates',                   // VendorRatesCollection
        'receiptAmount',           // float
        'receiptQuantity',         // float
        'receiptQuantityDiff',     // float
        'refName',                 // string, [read_only]
        'representingsubsidiary',  // Subsidiary
        'requirePwdChange',        // bool
        'roles',                   // VendorRolesCollection
        'salutation',              // string
        'sendEmail',               // bool
        'shipAddr1',               // string
        'shipAddr2',               // string
        'shipAddr3',               // string
        'shipAddressee',           // string
        'shipAttention',           // string
        'shipCity',                // string
        'shipCountry',             // string
        'shipState',               // string
        'shipZip',                 // string
        'shipping_country',        // string enum(PR, PS, PT, PW, PY, QA, AD, AE, AF, AG)
        'subMachine',              // VendorSubMachineCollection
        'subscriptionMessageHistory',// VendorSubscriptionMessageHistoryCollection
        'subscriptions',           // VendorSubscriptionsCollection
        'subsidiary',              // Subsidiary
        'subsidiaryEdition',       // string
        'taxFractionUnit',         // string enum(2, 1, 0, -1, -2)
        'taxIdNum',                // string
        'taxItem',                 // NsResource
        'taxRegistration',         // VendorTaxRegistrationCollection
        'taxRounding',             // string enum(DOWN, UP, OFF)
        'tegataMaturity',          // int
        'terms',                   // Term
        'timeApprover',            // Employee
        'title',                   // string
        'unbilledOrders',          // float
        'unbilledOrdersPrimary',   // float
        'url',                     // string
        'vatRegNumber',            // string
        'vendBillMatchKey',        // int
        'workCalendar',            // NsResource
    ];    

   /**
    * GET /vendor
    * 
    * @param string $q                 Search query used to filter results. (in query)
    * @param int $limit                The limit used to specify the number of results on a single page. (in query)
    * @param int $offset               The offset used for selecting a specific page of results. (in query)
    * @return string json:vendorCollection - List of records
    * @response [default] nsError - Error response
    */
    public function getListOfRecords($q = null, $limit = null, $offset = null)
    {
        $parts = [];
        $path = "/vendor";
        if ($q) {
            $parts[] = 'q=' . urlencode((string)$q);
        }
        if ($limit) {
            $parts[] = 'limit=' . urlencode((string)$limit);
        }
        if ($offset) {
            $parts[] = 'offset=' . urlencode((string)$offset);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('GET', $path);

        return $response;
    }

   /**
    * POST /vendor
    * 
    * @param $body {vendor}
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @response [204 No Content]  - Inserted record
    * @response [default] nsError - Error response
    */
    public function insertRecord($body, $replace = null, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null)
    {
        $parts = [];
        $path = "/vendor";
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('POST', $path, $body);

        return $response;
    }

   /**
    * DELETE /vendor/{id}
    * 
    * @param numeric $id [Required]    Internal identifier (in path)
    * @response [204 No Content]  - Removed record
    * @response [default] nsError - Error response
    */
    public function removeRecord($id = null)
    {
        $path = "/vendor/$id";
        $response = $this->_makeRequest('DELETE', $path);

        return $response;
    }

   /**
    * GET /vendor/{id}
    * 
    * @param numeric $id [Required]    Internal identifier (in path)
    * @param bool $expandSubResources  Set to true to automatically expand all sublists, sublist lines and subrecords on this record. (in query)
    * @return string json:vendor - Retrieved record
    * @response [default] nsError - Error response
    */
    public function getRecord($id = null, $expandSubResources = null)
    {
        $parts = [];
        $path = "/vendor/$id";
        if ($expandSubResources) {
            $parts[] = 'expandSubResources=' . urlencode((string)$expandSubResources);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('GET', $path);

        return $response;
    }

   /**
    * PATCH /vendor/{id}
    * 
    * @param $body {vendor}
    * @param numeric $id [Required]    Internal identifier (in path)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @response [204 No Content]  - Updated record
    * @response [default] nsError - Error response
    */
    public function updateRecord($body, $id = null, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null)
    {
        $parts = [];
        $path = "/vendor/$id";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('PATCH', $path, $body);

        return $response;
    }

   /**
    * PUT /vendor/{id}
    * 
    * @param $body {vendor}
    * @param string $id [Required]     External identifier (in path)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @response [204 No Content]  - Upserted record
    * @response [default] nsError - Error response
    */
    public function insertOrUpdateRecord($body, $id = null, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null)
    {
        $parts = [];
        $path = "/vendor/$id";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('PUT', $path, $body);

        return $response;
    }

   /**
    * POST /vendor/{id}/!transform/customer
    * 
    * @param $body {customer}
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @param numeric $id [Required]    Internal identifier (in path)
    * @response [204 No Content] customer - Transformed record
    * @response [default] nsError - Error response
    */
    public function transformToCustomer($body, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null, $id = null)
    {
        $parts = [];
        $path = "/vendor/$id/!transform/customer";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('POST', $path, $body);

        return $response;
    }

   /**
    * POST /vendor/{id}/!transform/purchaseOrder
    * 
    * @param $body {purchaseOrder}
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @param numeric $id [Required]    Internal identifier (in path)
    * @response [204 No Content] purchaseOrder - Transformed record
    * @response [default] nsError - Error response
    */
    public function transformToPurchaseOrder($body, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null, $id = null)
    {
        $parts = [];
        $path = "/vendor/$id/!transform/purchaseOrder";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('POST', $path, $body);

        return $response;
    }

   /**
    * POST /vendor/{id}/!transform/vendorBill
    * 
    * @param $body {vendorBill}
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @param numeric $id [Required]    Internal identifier (in path)
    * @response [204 No Content] vendorBill - Transformed record
    * @response [default] nsError - Error response
    */
    public function transformToVendorBill($body, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null, $id = null)
    {
        $parts = [];
        $path = "/vendor/$id/!transform/vendorBill";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('POST', $path, $body);

        return $response;
    }

   /**
    * POST /vendor/{id}/!transform/vendorPayment
    * 
    * @param $body {vendorPayment}
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyNameValidationSets strictness of property name validation. (in header)
    * @param string enum(Error, Warning, Ignore) $xNetSuitePropertyValueValidationSets strictness of property value validation. (in header)
    * @param string $replace           Names of sublists on this record. All lines on these sublists will be replaced with lines from input. Sublists not specified here will have lines added to record. Names are delimited by comma. (in query)
    * @param numeric $id [Required]    Internal identifier (in path)
    * @response [204 No Content] vendorPayment - Transformed record
    * @response [default] nsError - Error response
    */
    public function transformToVendorPayment($body, $xNetSuitePropertyNameValidation = null, $xNetSuitePropertyValueValidation = null, $replace = null, $id = null)
    {
        $parts = [];
        $path = "/vendor/$id/!transform/vendorPayment";
        if ($xNetSuitePropertyNameValidation) {
            $parts[] = 'X-NetSuite-PropertyNameValidation=' . urlencode((string)$xNetSuitePropertyNameValidation);
        }
        if ($xNetSuitePropertyValueValidation) {
            $parts[] = 'X-NetSuite-PropertyValueValidation=' . urlencode((string)$xNetSuitePropertyValueValidation);
        }
        if ($replace) {
            $parts[] = 'replace=' . urlencode((string)$replace);
        }
        if ($parts) {
            $path .= '?' . implode('&', $parts);
        }
        $response = $this->_makeRequest('POST', $path, $body);

        return $response;
    }
}
