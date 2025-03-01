<?php
namespace App\Interfaces;

interface GlobalVariablesInterface {
    const FIRST_STEP = 1;
    const CONFIRMING_STEP = 2;
    const DELIVERY_STEP = 3;
    const DELIVERING_STEP = 4;
    const RETURN_TO_WAREHOUSE_STEP = 5;
    const CANCEL_STEP = 6;
    const ARCHIVE_STEP = 7;


    const DELIVERED = 1;
    const NOTDELIVERED = 1;

    const CONFIRMED = 1;
    const NOTCONFIRMED = 0;


    const DELIVERY_ACTIVE_DEFAULT = 1;
    const DELIVERY_ONLINE_DEFAULT = 0;

    const LOGIN_EXPIRED_TIME = 60*24;

    const DEFAULT_USER_ID = 1;
    const DEFAULT_UNIT_ID = 1;

    const START_RANGE_FOR_GENERATE_NUMBER = 1000;
    const END_RANGE_FOR_GENERATE_NUMBER = 9999;
    
    const START_RANGE_FOR_RANDOM_REQUEST_NUMBER = 10;
    const END_RANGE_FOR_RANDOM_REQUEST_NUMBER = 99;

    const PAGINATE_NUMBER_DEFAULT = 100;

    const WAREHOUSE_DELIVERY_ACTIVE_DEFAULT = 1;

    const OLD_DATA_FLAG = 'OLD';
    const NEW_DATA_FLAG = 'NEW';
}