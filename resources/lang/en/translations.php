<?php

/* Translation file. Array keys are arranged alphabetically */

return [
    /* Buttons */
    'buttons' => [
        'adjust_stock' => 'Adjust Stock',
        'back_to_shop' => 'Back to shop',
        'buy' => 'Buy Now',
        'continue_shopping' => 'Continue Shopping',
        'delete' => 'Delete',
        'login' => 'Login',
        'payment_sent' => 'Payment Sent',
        'place_order' => 'Place order',
        'register' => 'Register',
        'save' => 'Save',
        'sent' => 'Sent',
        'submit' => 'Submit'
    ],
    /* Headings and subheadings */
    'headings' => [
        'api_keys' => 'API Keys',
        'basic_info' => 'Basic Info',
        'country_and_code' => 'Country & Calling Code',
        'crypto_address' => ':ticker Address',
        'gemini' => 'Gemini',
        'manage' => 'Manage',
        'menu' => 'Menu',
        'order' => 'Order',
        'order_summary' => 'Order Summary',
        'payment_info' => 'Payment Information',
        'payment_owed' => ':tickerSymbol is still owed',
        'payment_success' => 'Thank you for your order',
        'pending_shipment' => 'Pending Shipment',
        'price' => 'Price',
        'product' => 'Product',
        'qty' => 'Qty',
        'sent_shipment' => 'Sent Shipment',
        'settings' => 'Settings',
        'shipping_details' => 'Shipping Details',
        'tracking_info' => 'Tracking Info',
        'tracking_number' => 'Tracking Number',
        'uses_crypto' => 'Payment is made with :ticker, Upon order completion you will be redirected to a confirmation page and recieve a text message on your phone'
    ],
    /* Input labels and placeholders*/
    'labels' => [
        'address_1' => 'Address Line 1',
        'address_2' => 'Address Line 2',
        'amount' => 'Amount',
        'calling_code' => 'Calling Code',
        'city' => 'City',
        'code' => 'Code',
        'country' => 'Country',
        'currency' => 'Currency',
        'currency_symbol' => '$',
        'description' => 'Description',
        'email' => 'Email',
        'item' => 'Item',
        'key' => 'Key',
        'name' => 'Name',
        'options' => 'Options',
        'orders' => 'Orders',
        'order_no' => 'Order no.',
        'password' => 'Password',
        'phone' => 'Phone',
        'phone_tracking' => 'Tracking will be sent via SMS',
        'photo' => 'Photo',
        'postal' => 'Postal',
        'price' => 'Price',
        'product' => 'Product',
        'secret' => 'Secret',
        'site_name' => 'Site Name',
        'shipping' => 'Shipping',
        'state' => 'State/Province',
        'stock' => 'Stock',
        'ticker_symbol' => 'BTC',
        'tracking_number' => 'Tracking Number',
        'username' => 'Username',
    ],
    /* Notifications */
    'notifications' => [
        'added' => 'was added',
        'bad_address' => 'Bad Address, please contact us and let us know you are seeing this message',
        'created' => 'was created',
        'crypto_api_error' => 'Error with API calls & setting :tickerSymbol prices. Please check internet connection and reload page',
        'crypto_down' => 'Sorry, Looks like our :tickerSymbol exchange is down',
        'deleted' => 'was deleted',
        'gemini_no_key' => 'You have not entered your Gemini API Keys yet',
        'internet_error' => 'Error with the Internet, Please try again',
        'keySaved' => 'Your new keys were saved',
        'crypto_api_error_e1' => 'Error, Unable to generate :tickerSymbol address, please check internet connection and retry.',
        'crypto_api_error_e2' => 'Error, Unable to generate :tickerSymbol address, please check internet connection and retry.',
        'not_saved' => 'Data not saved.',
        'notSaved' => 'There was an error saving your keys',
        'shipmentSent' => 'Shipment sent',
        'updated' => 'was updated',
    ],
    /* SMS messages */
    'sms' => [
        'shippingCreated' => "Eccomerce here, Your order has been received & we'll update you shortly with tracking information. Order # :productName",
        'shippingSent' => "Eccomerce here, Your order #:productName was just sent with :carrier. Tracking # :trackingNumber"
    ],
    /* Paragraphs and text */
    'texts' => [
        'cart' => 'Cart',
        'check_payment' => 'Checking Payment, 15 Seconds',
        'delete_confirm' => 'Are you sure you want to delete',
        'free' => 'Free',
        'logout' => 'logout',
        'minutes_to_exchange' => ':tickerSymbol may take 10 minutes to confirm',
        'no_products' => 'There are no products',
        'no_pending' => 'There are no pending shipments',
        'no_sent' => 'There are no sent shipments',
        'order_number' => 'Order Number:',
        'refresh' => "Don't refresh the page",
        'seconds_to_confirm' => 'Most wallets take 10 seconds to confirm',
        'send_again' => "If you believe this to be an error please click 'Payment Sent' again",
        'send_remaining' => "Please send the remaining amount and click 'Payment Sent'",
        'shipping_time' => 'Will ship within 48 hours to',
        'total' => 'Total'
    ],
    'countries' => [
        'united_states' => 'United States',
        'china' => 'China',
        'macau' => 'Macau',
        'hong_kong' => 'Hong Kong',
        'taiwan' => 'Taiwan',
        'United States' => 'United States',
        'China' => 'China',
        'Macau' => 'Macau',
        'Hong Kong' => 'Hong Kong',
        'Taiwan' => 'Taiwan'
    ]
];


/*

//add this to validition.php

 'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        'callingCode' => [ // custom validation message for calling code not_regex
            'not_regex' => 'The calling code field is required.'
        ],
        'country' => [
            'not_regex' => 'Country is Required.',
            'required_calling_code' => 'Country calling code is required.'
        ],
        'phone' => [ // custom validation message for phone review
            'not_found' => 'Phone number not found.',
            'not_allowed' => 'Only one review per order allowed.'
        ]
    ],

    'attributes' => [
        'comment' => 'comment',
        'phone' => 'phone'
    ],

];

*/