<?php
namespace App\Interfaces;

interface RayvarzInterface {
    const TOKEN_EXPIRED_TIME = 60*60;

    const DEFAULT_INVENTORY_DOCUMENT_TYPE_ID = 40;
    const DEFAULT_DOCUMENT_ROW = 1;
    const DEFAULT_INVENTORY_ORDER_ID = 1;
    const DEFAULT_ITEM_CONSUMPTION_TYPE_ID = 72003025;
    const DEFAULT_UNIT_ID = 2;
    const DEFAULT_USER_ID = 1;
}