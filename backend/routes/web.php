<?php

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// login
$router->post('/login', 'AuthenticateController@Login');
// paises
$router->get('/list-countries', 'DataController@ListCountry');
//correlative
$router->get('/get-correlative/{name}', 'DataController@GetCorrelative');
// usuarios
$router->group(['prefix' => 'user','middleware' => 'role'], function () use ($router) {
    $router->get('/list-active', 'UserController@ListActive');
});
// clientes
$router->group(['prefix' => 'client','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'ClientController@ListAll');
    $router->get('/view/{id_client}', 'ClientController@View');
    $router->put('/edit', 'ClientController@Update');
    $router->get('/search-clients/{search}', 'ClientController@Search');
});

// recargas
$router->group(['prefix' => 'recharge','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'RechargeController@ListAll');
    $router->post('/add', 'RechargeController@Store');
    $router->get('/view/{id_recharge}', 'RechargeController@View');
    $router->post('/edit', 'RechargeController@Update');
    $router->post('/cancel', 'RechargeController@Cancel');

    $router->get('/history-client/{id_client}', 'RechargeController@HistoryByClient');
});

// reporte
$router->get('/excel-recharge/{id_client}/{id_user}/{from}/{to}/{communication_channel}/{payment_method}/{bank}/{coin}', 'ReportController@RechargeExcel');
$router->get('/excel-recharge-cancel/{id_client}/{id_user}/{from}/{to}/{communication_channel}/{payment_method}/{bank}/{coin}', 'ReportController@RechargeExcelCancel');
$router->group(['prefix' => 'report','middleware' => 'role'], function () use ($router) {
    $router->post('/recharge', 'ReportController@Recharge');
    $router->post('/recharge-cancel', 'ReportController@RechargeCancel');
});






















// $router->get('/api', 'SaleController@Guzzle');


$router->get('/list-states/{c1ountry_code}', 'DataController@ListStates');
$router->get('/list-ubigee', 'DataController@ListUbigee');

$router->get('/get-business', 'BusinessController@GetBusiness');
$router->get('/sending_automatic_receipts', 'SaleController@SendingAutomaticReceipts');
$router->get('/backup_sql', 'BackupController@Database');
$router->put('/update-profile', 'UserController@UpdateProfile');
$router->get('/user-view/{id_user}', 'UserController@View');
$router->post('/number-to-letters', 'DataController@NumberToLetters');
$router->post('/get-sale-cpe', 'SaleController@GetSaleCPE');

//inicio
$router->group(['prefix' => 'home'], function () use ($router) {
       $router->get('/total-home', 'HomeController@TotalHome');


    // $router->get('/list-observed-sale', 'HomeController@ListObservedSales');
    // $router->get('/list-observed-redeemed-sale', 'HomeController@ListObservedReemedSales');
    // $router->get('/list-observed-sale-low', 'HomeController@ListObservedSalesLow');
 
    // $router->get('/send-xml-sale/{id_sale}', 'SaleController@SendXML');
    // $router->get('/send-xml-redeemed-sale/{id_redeemed_sale}', 'RedeemedSaleController@SendXML');
    // $router->get('/send-xml-sale-low/{id_sale}', 'SaleController@SendSaleLowXML');
    // $router->get('/list-products-delivered/{id_establishment}/{search}', 'HomeController@ListSalesDelivered');
    // $router->get('/sale-delivered/{id_sale}', 'HomeController@SaleDelivered');



    $router->post('/stock-letter', 'CateringController@StockLetter');


});

//empresa
$router->get('/get-business', 'BusinessController@GetBusiness');
$router->group(['prefix' => 'business','middleware' => 'role'], function () use ($router) {
    $router->get('/get-business', 'BusinessController@GetBusiness');
    $router->post('/edit', 'BusinessController@Update');
    $router->post('/edit-theme', 'BusinessController@UpdateTheme');
});
//tipo de usuario
$router->get('/usertype-list-active', 'UserTypeController@ListActive');
$router->group(['prefix' => 'user-type','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'UserTypeController@ListAll');
    $router->get('/modules', 'UserTypeController@ListModules');
    $router->post('/add', 'UserTypeController@Store');
    $router->get('/view/{id_user_type}', 'UserTypeController@View');
    $router->put('/edit', 'UserTypeController@Update');
    $router->delete('/delete/{id_user_type}', 'UserTypeController@Delete');
    
});
//usuario
$router->get('/active-users', 'UserController@ListActive');
$router->group(['prefix' => 'user','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'UserController@ListAll');
    $router->post('/add', 'UserController@Store');
    $router->get('/view/{id_user}', 'UserController@View');
    $router->put('/edit', 'UserController@Update');
    $router->delete('/delete/{id_user}', 'UserController@Delete');
});

//clientes

$router->get('/excel-clients', 'ClientController@ExcelClient');

//proveedores
$router->get('/search-providers/{search}', 'ProviderController@SearchProviders');
$router->get('/excel-providers', 'ProviderController@ExcelProvider');
$router->group(['prefix' => 'provider','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'ProviderController@ListAll');
    $router->post('/add', 'ProviderController@Store');
    $router->get('/view/{id_provider}', 'ProviderController@View');
    $router->put('/edit', 'ProviderController@Update');
    $router->delete('/delete/{id_provider}', 'ProviderController@Delete');
});

// salas
$router->group(['prefix' => 'room','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'RoomController@ListAll');
    $router->post('/add', 'RoomController@Store');
    $router->get('/view/{id_room}', 'RoomController@View');
    $router->put('/edit', 'RoomController@Update');
    $router->delete('/delete/{id_room}', 'RoomController@Delete');

    $router->get('/list-active', 'RoomController@ListActive');
});


// mesas
$router->group(['prefix' => 'table','middleware' => 'role'], function () use ($router) {
    $router->get('/list', 'TableController@ListAll');
    $router->post('/add', 'TableController@Store');
    $router->get('/view/{id_table}', 'TableController@View');
    $router->put('/edit', 'TableController@Update');

    $router->get('/list-active-by-user/{id_user}', 'TableController@ListActiveByUser');
    $router->get('/list-active', 'TableController@ListActive');
    $router->get('/list-tables-active/{id_room}', 'TableController@ListTableActive');
    $router->get('/list-tables-active-general', 'TableController@ListTableActiveGeneral');
    $router->get('/list-tables-select', 'TableController@ListTableActiveSelect');
    

    $router->put('/move', 'TableController@Move');
    $router->put('/resize', 'TableController@Resize');
    $router->put('/delete', 'TableController@Delete');
});

//categoria productos
$router->group(['prefix' => 'category-product','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'CategoryProductController@ListAll');
    $router->post('/add', 'CategoryProductController@Store');
    $router->get('/view/{id_category_product}', 'CategoryProductController@View');
    $router->post('/edit', 'CategoryProductController@Update');
    $router->delete('/delete/{id_category_product}', 'CategoryProductController@Delete');

    $router->get('/list-active', 'CategoryProductController@ListActive');
});


//productos
$router->get('/excel-products', 'ProductController@ExcelProduct');
$router->get('/excel-product-resource', 'ProductController@ExcelProductResource');
$router->get('/excel-product-template', 'ProductController@ExcelProductTemplate');

$router->group(['prefix' => 'product','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'ProductController@ListAll');
    $router->post('/add', 'ProductController@Store');
    $router->get('/view/{id_product}', 'ProductController@View');
    $router->post('/edit', 'ProductController@Update');
    
    $router->post('/search', 'ProductController@Search');
    $router->post('/search-stock', 'ProductController@SearchStock');
    $router->post('/search-select', 'ProductController@SearchSelect');

    $router->post('/import-excel', 'ProductController@ImportExcelProducts');

    $router->post('/add-product-supplies', 'ProductController@StoreProductSupplies');
    $router->post('/update-product-supplies', 'ProductController@UpdateProductSupplies');
    $router->delete('/delete-product-supplies/{id_product_supplies}', 'ProductController@DeleteProductSupplies');
    $router->post('/search-supplies', 'ProductController@SearchSupplies');
    $router->post('/search-select-supplies', 'ProductController@SearchSelectSupplies');
});


//categoria carta
$router->group(['prefix' => 'category-letter','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'CategoryLetterController@ListAll');
    $router->post('/add', 'CategoryLetterController@Store');
    $router->get('/view/{id_category_product}', 'CategoryLetterController@View');
    $router->post('/edit', 'CategoryLetterController@Update');
    $router->delete('/delete/{id_category_product}', 'CategoryLetterController@Delete');

    $router->get('/list-active', 'CategoryLetterController@ListActive');
});


//carta
$router->get('/excel-letters', 'LetterController@ExcelLetter');
$router->group(['prefix' => 'letter','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'LetterController@ListAll');
    $router->post('/add', 'LetterController@Store');
    $router->get('/view/{id_letter}', 'LetterController@View');
    $router->post('/edit', 'LetterController@Update');
    $router->delete('/delete/{id_letter}', 'LetterController@Delete');
    
    $router->post('/search-by-category', 'LetterController@SearchByCategory');
    $router->post('/search', 'LetterController@Search');
    $router->post('/search-stock', 'LetterController@SearchStock');
    $router->post('/search-stock-delivery', 'LetterController@SearchStockDelivery');

    $router->post('/letter-actives', 'LetterController@LetterActives');
    $router->get('/letter-observation/{id_letter}', 'LetterController@LetterObservation');
    $router->get('/list-by-category/{id_category_letter}', 'LetterController@ListByCategory');
});


//comprobantes
$router->group(['prefix' => 'voucher','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'VoucherController@ListAll');
    $router->post('/add', 'VoucherController@Store');
    $router->get('/view/{id_voucher}', 'VoucherController@View');
    $router->put('/edit', 'VoucherController@Update');
    $router->delete('/delete/{id_voucher}', 'VoucherController@Delete');
});

//series
$router->group(['prefix' => 'serie','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_voucher}/{search}', 'SerieController@ListAll');
    $router->post('/add', 'SerieController@Store');
    $router->get('/view/{id_serie}', 'SerieController@View');
    $router->put('/edit', 'SerieController@Update');
    $router->delete('/delete/{id_serie}', 'SerieController@Delete');

    $router->get('/list-series-by-code/{type_invoice}', 'SerieController@GetSeries');
});

//almacen
$router->group(['prefix' => 'warehouse','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'WarehouseController@ListAll');
    $router->post('/add', 'WarehouseController@Store');
    $router->get('/view/{id_warehouse}', 'WarehouseController@View');
    $router->put('/edit', 'WarehouseController@Update');
    $router->delete('/delete/{id_warehouse}', 'WarehouseController@Delete');

    $router->get('/list-active', 'WarehouseController@ListActive');
});


//entradas
$router->group(['prefix' => 'input','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_provider}/{from}/{to}/{search}', 'InputController@ListAll');
    $router->post('/add', 'InputController@Store');
    $router->get('/view/{id_input}', 'InputController@View');
    $router->put('/edit', 'InputController@Update');
    $router->delete('/delete/{id_input}', 'InputController@Delete');
    $router->delete('/cancel/{id_input}', 'InputController@Cancel');

    $router->get('/list-pending/{id_provider}/{from}/{to}/{search}', 'InputController@ListPending');
});
//salidas
$router->group(['prefix' => 'output','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_provider}/{from}/{to}/{search}', 'OutputController@ListAll');
    $router->post('/add', 'OutputController@Store');
    $router->get('/view/{id_output}', 'OutputController@View');
    $router->put('/edit', 'OutputController@Update');
    $router->delete('/delete/{id_output}', 'OutputController@Delete');
    $router->delete('/cancel/{id_output}', 'OutputController@Cancel');
    $router->get('/list-transfers/{search}', 'OutputController@ListTranfers');

});

//compras
$router->group(['prefix' => 'shopping','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_provider}/{from}/{to}/{search}', 'ShoppingController@ListAll');
    $router->post('/add', 'ShoppingController@Store');
    $router->get('/view/{id_shopping}', 'ShoppingController@View');
    $router->put('/edit', 'ShoppingController@Update');
    $router->delete('/delete/{id_shopping}', 'ShoppingController@Delete');

    $router->put('/costing', 'ShoppingController@Costing');
    $router->delete('/delete-costing/{id_shopping}', 'ShoppingController@DeleteCosting');
});


//moso
$router->group(['prefix' => 'moso','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'MosoController@ListAll');
    $router->post('/add', 'MosoController@Store');
    $router->get('/view/{id_shopping}', 'MosoController@View');
    $router->put('/edit', 'MosoController@Update');
    $router->delete('/delete/{id_shopping}', 'MosoController@Delete');


    $router->post('/get-by-code', 'MosoController@GetByCode');
    $router->get('/list-active', 'MosoController@ListActive');
    $router->post('/mozo-master', 'MosoController@MosoMaster');
});

//salidas
$router->group(['prefix' => 'transformation','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{from}/{to}/{search}', 'TransformationController@ListAll');
    $router->post('/add', 'TransformationController@Store');
    $router->get('/view/{id_transformation}', 'TransformationController@View');
    $router->delete('/delete/{id_transformation}', 'TransformationController@Delete');
    $router->delete('/cancel/{id_transformation}', 'TransformationController@Cancel');

});

//orden de pedido
$router->group(['prefix' => 'purchase-order-user','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{from}/{to}/{search}', 'PurchaseOrderUserController@ListAll');
    $router->post('/add', 'PurchaseOrderUserController@Store');
    $router->get('/view/{id_purchase_order_user}', 'PurchaseOrderUserController@View');
    $router->put('/edit', 'PurchaseOrderUserController@Update');
    $router->delete('/delete/{id_purchase_order_user}', 'PurchaseOrderUserController@Delete');
    $router->get('/list-pending/{from}/{to}/{search}', 'PurchaseOrderUserController@ListPending');
});

//orden de compra
$router->group(['prefix' => 'purchase-order','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_provider}/{from}/{to}/{search}', 'PurchaseOrderController@ListAll');
    $router->post('/add', 'PurchaseOrderController@Store');
    $router->get('/view/{id_purchase_order}', 'PurchaseOrderController@View');
    $router->put('/edit', 'PurchaseOrderController@Update');
    $router->delete('/delete/{id_purchase_order}', 'PurchaseOrderController@Delete');
    $router->get('/list-pending/{id_provider}/{from}/{to}/{search}', 'PurchaseOrderController@ListPending');
});

//caja
$router->get('/box-export-excel/{id_box}', 'BoxController@ExportExcel');
$router->group(['prefix' => 'box','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_user}/{search}', 'BoxController@ListAll');
    $router->post('/add', 'BoxController@Store');
    $router->get('/view/{id_shopping}', 'BoxController@View');
    $router->put('/edit', 'BoxController@Update');
    $router->delete('/delete/{id_shopping}', 'BoxController@Delete');


    $router->get('/get-box-by-user/{id_user}', 'BoxController@GetBoxByUser');
    $router->get('/boxes-actives', 'BoxController@BoxesActives');
    $router->post('/validate-open-box', 'BoxController@ValidateOpenBox');
    $router->post('/calculate-box', 'BoxController@CalculateBox');
    $router->post('/close', 'BoxController@Close');
    $router->post('/reopen', 'BoxController@ReOpen');


    $router->get('/charge-summary/{id_box}', 'BoxController@ChargeSummary');
    $router->get('/payment-summary/{id_box}', 'BoxController@PaymentSummary');

    $router->get('/account-charge-summary/{id_box}', 'BoxController@AccountChargeSummary');
    $router->get('/account-payment-summary/{id_box}', 'BoxController@AccountPaymentSummary');

    $router->get('/extraordinary-income-summary/{id_box}', 'BoxController@ExtraordinaryIncome');
    $router->get('/extraordinary-expense-summary/{id_box}', 'BoxController@ExtraordinaryExpense');
});

//ingreso extraordinario
$router->group(['prefix' => 'extraordinary-income','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_client}/{from}/{to}/{search}', 'ExtraordinaryIncomeController@ListAll');
    $router->post('/add', 'ExtraordinaryIncomeController@Store');
    $router->get('/view/{id_extraordinary_income}', 'ExtraordinaryIncomeController@View');
    $router->put('/edit', 'ExtraordinaryIncomeController@Update');
    $router->delete('/delete/{id_extraordinary_income}', 'ExtraordinaryIncomeController@Delete');
});

//egreso extraordinario
$router->group(['prefix' => 'extraordinary-expense','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_provider}/{from}/{to}/{search}', 'ExtraordinaryExpenseController@ListAll');
    $router->post('/add', 'ExtraordinaryExpenseController@Store');
    $router->get('/view/{id_extraordinary_expense}', 'ExtraordinaryExpenseController@View');
    $router->put('/edit', 'ExtraordinaryExpenseController@Update');
    $router->delete('/delete/{id_extraordinary_expense}', 'ExtraordinaryExpenseController@Delete');
});


//abastecimiento
$router->group(['prefix' => 'catering','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'CateringController@ListAll');
    $router->post('/add', 'CateringController@Store');
    $router->get('/view/{id_catering}', 'CateringController@View');
    $router->put('/edit', 'CateringController@Update');
    $router->delete('/delete/{id_catering}', 'CateringController@Delete');
});


//pedidos
$router->group(['prefix' => 'order','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}/{from}/{to}', 'OrderController@ListAll');
    $router->post('/add', 'OrderController@Store');
    $router->post('/add-master-key', 'OrderController@StoreMasterKey');
    $router->get('/view/{id_order}', 'OrderController@View');
    $router->put('/payment', 'OrderController@Payment');
    $router->put('/edit', 'OrderController@Update');
    $router->delete('/delete/{id_order}', 'OrderController@Delete');
    $router->delete('/cancel/{id_order}', 'OrderController@Cancel');
    $router->post('/add-reservation', 'OrderController@AddReservation');
    $router->post('/delete-reservation', 'OrderController@DeleteReservation');

    $router->get('/get-order-active/{id_table}', 'OrderController@GetOrderActive');

    $router->post('/add-order-detail', 'OrderController@AddOrderDetail');
    $router->get('/view-order-detail/{id_order_detail}', 'OrderController@ViewOrderDetail');
    $router->post('/cancel-order-detail', 'OrderController@CancelOrderDetail');
    $router->post('/change-order-detail', 'OrderController@ChangeOrderDetail');
    $router->post('/send-letter-fund', 'OrderController@SendLetterFund');
    

    $router->post('/change-table', 'OrderController@ChangeTable');
    $router->post('/update-paxs', 'OrderController@UpdatePaxs');
    
    //print
    $router->get('/data-print/{id_order}', 'OrderController@DataPrint');
    $router->get('/re-open/{id_order}', 'OrderController@ReOpen');
    //sale
    $router->get('/get-order-detail/{id_order}', 'OrderController@GetDetailSale');

    $router->post('/edit-price-detail', 'OrderController@EditPriceDetail');
    $router->post('/edit-name-detail', 'OrderController@EditNameDetail');

    $router->get('/order-actives', 'OrderController@OrderActives');
    $router->post('/change-letter-table', 'OrderController@ChangeLetterTable');
    
    
    $router->post('/trash-order-detail', 'OrderController@TrashOrderDetail');
});


//cuentas por cobrar
$router->group(['prefix' => 'account-receivable','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{type}/{id_client}/{search}', 'AccountReceivableController@ListAll');
    $router->get('/list-eecc', 'AccountReceivableController@ListEECC');
    $router->post('/add', 'AccountReceivableController@Store');
    $router->get('/view/{id}', 'AccountReceivableController@View');
    $router->put('/edit', 'AccountReceivableController@Update');
    $router->delete('/delete/{id}', 'AccountReceivableController@Delete');
    $router->delete('/cancel/{id}', 'AccountReceivableController@Cancel');

    $router->get('/list-charge/{id_account_receivable}', 'AccountReceivableController@ListCharge');
    $router->post('/add-charge', 'AccountReceivableController@StoreCharge');
    $router->put('/edit-charge', 'AccountReceivableController@UpdateCharge');
    $router->get('/view-charge/{id_account_charge}', 'AccountReceivableController@ViewCharge');
    $router->delete('/delete-charge/{id_account_charge}', 'AccountReceivableController@DeleteCharge');
});


//cuentas por pagar
$router->group(['prefix' => 'account-pay','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{type}/{id_provider}/{search}', 'AccountPayController@ListAll');
    $router->get('/list-eecc', 'AccountPayController@ListEECC');
    $router->post('/add', 'AccountPayController@Store');
    $router->get('/view/{id}', 'AccountPayController@View');
    $router->put('/edit', 'AccountPayController@Update');
    $router->delete('/delete/{id}', 'AccountPayController@Delete');
    $router->delete('/cancel/{id}', 'AccountPayController@Cancel');


    $router->get('/list-payment/{id_account_pay}', 'AccountPayController@ListPayment');
    $router->post('/add-payment', 'AccountPayController@StorePayment');
    $router->put('/edit-payment', 'AccountPayController@UpdatePayment');
    $router->get('/view-payment/{id_account_payment}', 'AccountPayController@ViewPayment');
    $router->delete('/delete-payment/{id_account_payment}', 'AccountPayController@DeletePayment');
});


// kardex
$router->get('/excel-stock-general/{search}', 'KardexController@ExcelStockGeneral');
$router->get('/excel-stock-portions/{search}', 'KardexController@ExcelStockPortions');
$router->get('/excel-kardex-psysical/{id_warehouse}/{to}/{id_product}', 'KardexController@ExcelKardexPsysical');
$router->get('/excel-kardex-psysical-general/{id_warehouse}/{to}', 'KardexController@ExcelKardexPsysicalGeneral');
$router->group(['prefix' => 'kardex','middleware' => 'role'], function () use ($router) {
    $router->post('/physical', 'KardexController@KardexPhysical');
    $router->get('/stock-general/{search}', 'KardexController@StockGeneral');
    $router->get('/stock-portions/{search}', 'KardexController@StockPortions');
});


//cobros
$router->group(['prefix' => 'charge','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_user}/{id_client}/{from}/{to}/{search}', 'ChargeController@ListAll');
    $router->post('/add', 'ChargeController@Store');
    $router->get('/view/{id}', 'ChargeController@View');
    $router->put('/edit', 'ChargeController@Update');
    $router->delete('/delete/{id}', 'ChargeController@Delete');
});


//reserva
$router->group(['prefix' => 'reservation','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_client}/{from}/{to}/{search}', 'ReservationController@ListAll');
    $router->post('/add', 'ReservationController@Store');
    $router->get('/view/{id}', 'ReservationController@View');
    $router->put('/edit', 'ReservationController@Update');
    $router->delete('/delete/{id}', 'ReservationController@Delete');


    $router->get('/list-reservations/{search}', 'ReservationController@ListReservation');
});

//delivery
$router->group(['prefix' => 'delivery','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_user}/{id_client}/{from}/{to}/{search}', 'DeliveryController@ListAll');
    $router->post('/add', 'DeliveryController@Store');
    $router->get('/view/{id}', 'DeliveryController@View');
    $router->put('/edit', 'DeliveryController@Update');
    $router->delete('/delete/{id}', 'DeliveryController@Delete');

    $router->get('/finalize/{id}', 'DeliveryController@Finalize');
    $router->get('/get-delivery-detail/{id_delivery}', 'DeliveryController@GetDetailSale');
  
});

//tipo de cambio
$router->group(['prefix' => 'exchange-rate','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{search}', 'ExchangeRateController@ListAll');
    $router->post('/add', 'ExchangeRateController@Store');
    $router->get('/view/{id}', 'ExchangeRateController@View');
    $router->put('/edit', 'ExchangeRateController@Update');
    $router->delete('/delete/{id}', 'ExchangeRateController@Delete');

    $router->get('/finalize/{id}', 'ExchangeRateController@Finalize');
});


//venta
$router->get('/sale-download-resource/{id_sale}/{resource}', 'SaleController@DownloadResource');
$router->get('/voucher-sale/{id_sale}', 'SaleController@VoucherPDF');
$router->group(['prefix' => 'sale','middleware' => 'role'], function () use ($router) {
    $router->get('/list/{id_client}/{from}/{to}/{search}', 'SaleController@ListAll');
    $router->post('/add', 'SaleController@Store');
    $router->get('/view/{id_sale}', 'SaleController@View');
    $router->put('/edit', 'SaleController@Update');
    $router->delete('/delete/{id_sale}', 'SaleController@Delete');
    $router->get('/send-xml/{id_sale}', 'SaleController@SendXML');
    $router->get('/generate-xml/{id_sale}', 'SaleController@ReGenerateXML');
    $router->get('/consult-cdr/{id_sale}', 'SaleController@ConsultCDR');

    $router->get('/data-print/{id_sale}', 'SaleController@DataPrint');
    $router->post('/send-voucher-email', 'SaleController@SendVoucherEmail');
});


//venta bajas
$router->get('/daily-summary/{id_sale}', 'SaleLowController@DailySummary');
$router->group(['prefix' => 'sale-low','middleware' => 'role'], function () use ($router) {
    $router->post('/add', 'SaleLowController@Store');
});

//reporte
$router->get('/excel-report-order/{id_client}/{turn}/{coin}/{from}/{to}/{id_moso}', 'ReportController@OrderExcel');
$router->get('/excel-report-box/{id_user}/{from}/{to}', 'ReportController@BoxExcel');
$router->get('/excel-report-delivery/{id_client}/{coin}/{from}/{to}/{id_user}', 'ReportController@DeliveryExcel');
$router->get('/excel-report-dish/{id_moso}/{turn}/{id_category_letter}/{id_letter}/{type}/{from}/{to}', 'ReportController@DishExcel');
$router->get('/excel-report-dish-canceled/{id_moso}/{turn}/{id_category_letter}/{id_letter}/{from}/{to}', 'ReportController@DishCanceledExcel');
$router->get('/excel-report-dish-valued/{id_moso}/{turn}/{id_category_letter}/{id_letter}/{from}/{to}', 'ReportController@DishValuedExcel');
$router->get('/excel-report-price-modification/{id_moso}/{turn}/{id_category_letter}/{id_letter}/{from}/{to}', 'ReportController@PriceModificationExcel');
$router->get('/excel-report-pax/{id_moso}/{turn}/{from}/{to}', 'ReportController@PaxExcel');

$router->group(['prefix' => 'report','middleware' => 'role'], function () use ($router) {
    $router->post('/order', 'ReportController@Order');
    $router->post('/box', 'ReportController@Box');
    $router->post('/delivery', 'ReportController@Delivery');
    $router->post('/dish', 'ReportController@Dish');
    $router->post('/dish-canceled', 'ReportController@DishCanceled');
    $router->post('/dish-canceled-trash', 'ReportController@DishCanceledTrash');
    $router->post('/dish-valued', 'ReportController@DishValued');
    $router->post('/price-modification', 'ReportController@PriceModification');
    $router->post('/pax', 'ReportController@Pax');
});