<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use Illuminate\Http\Response;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */


     /**
      * N° de caso de prueba : PR-0001
      * Descripcion: Registrar Venta
      * Responsable: Yonathan William Mamani Calisya
      * Fecha: 08/09/2021
      */

    public function testRegisterSale()
    {
        $this->json('post', '/test/sale-add',[
                'id_client' => 1,
                'id_serie' => 2,
                'id_warehouse' => 1,
                'type_operation' => "01",
                'linkages' => array(),
                'type_invoice' => "03",
                'serie' => "B001",
                'number' => "00000021",
                'broadcast_date' => "2021-09-08",
                'broadcast_time' => "18:00:00",
                'expiration_date' => "2021-09-08",
                'web_pay' => 0,
                'coin' => "PEN",
                'address' => "",
                'way_to_pay' => "01-000",
                'payment_type' => "01",
                'payment_method' => "008",
                'payment_deadline' => "0",
                'fees_collected' => array(),
                'observation' => "",
                'license_plate' => "",
                'modified_document_type' => "",
                'modified_serie' => "",
                'modified_number' => "",
                'modified_emission_date' => "",
                'reason' => "",
                'support' => "",
                'sunat_message' => "",
                'hash_cpe' => "",
                'hash_cdr' => "",
                'taxed_operation' => "0.00",
                'exonerated_operation' => "7.00",
                'unaffected_operation' => "0.00",
                'discount' => "0.00",
                'subtotal' => "7.00",
                'igv' => "0.00",
                'total' => "7.00",
                'state' => "1",
                'number_to_letters' => "SON : SIETE CON 00/100 SOLES",
                'id_user' => 1,
                'id_establishment' => 1,
                'sale_detail' => array(
                    array(
                        'id_product' => 5,
                        'code' => "00001004",
                        'name' => "producto 5 ",
                        'presentation' => "",
                        'barcode' => "",
                        'unit_measure' => "NIU",
                        'igv' => "20",
                        'existence_type' => "01",
                        'quantity' => 1000,
                        'unit_price' => "7.00",
                        'total_price' => "7.00"
                    )
                ),
                'payment_cash' => array(
                    array(
                        'id_charge' => "",
                        'payment_method' => "008",
                        'document' => "",
                        'total' => "7.00"
                    )
                )
                  
              
            ],['module'=>'Sale','role'=>2,'token' => 'RnciX827gfSzPG6HGDFBxKG7jEbAJiATVZ3XwtWLhp77yUsGXzx1O7QHHLYs'])
            ->seeJson([
                'status' => 201,
            ]);

    }


















    // //LISTAR CATEGORIAS
    // public function testListCategories()
    // {
    //     $this->json('get', '/active-categories')
    //          ->seeJson([
    //             'status' => 200,
    //          ]);

    // }

    // //LISTAR PORTADAS
    // public function testListCoverPage()
    // {
    //     $this->json('get', '/active-cover-page')
    //          ->seeJson([
    //             'status' => 200,
    //          ]);

    // }

    // // PRODUCTOS DESCTACADOS
    // public function testListFeatureProducts()
    // {
    //     $this->json('get', '/featured-products')
    //          ->seeJson([
    //             'status' => 200,
    //          ]);

    // }

    // // INFORMACION DEL PRODUCTO
    // public function testInfoByProduct()
    // {
    //     $this->json('get', '/info-by-product/5')
    //          ->seeJson([
    //             'status' => 200,
    //          ]);
    // }
    
    // //LISTAR PRODUCTO POR CATEGORIA
    // public function testListProductsByCategory()
    // {
    //     $this->json('get', '/search-products-by-category/2')
    //          ->seeJson([
    //             'status' => 200,
    //          ]);

    // }
   

    // // REGISTRAR NUEVO CLIENTE
    //  public function testRegisterClient()
    // {
    //     $this->json('post', '/register',[
    //         'document_type' => '1',
    //         'document_number' => '111111415',
    //         'name' => 'robertp',
    //         'email' => 'yonathanwilliammc1@gmail.com',
    //         'password' => '70359383'
    //         ])
    //          ->seeJson([
    //             'status' => 201,
    //          ]);
    // }

    
      
    
    // ///// REGISTRAR PEDIDO
    // public function testRegisterOrder()
    // {
    //     $this->json('post', '/test/order-add',[
    //             'id_client' => 8,
    //             'number_of_order' => '00001',
    //             'description' => '',
    //             'reference' => '',
    //             'subtotal' => 10,
    //             'discount' => 0,
    //             'delivery_cost' => 0,
    //             'total' => 10,
    //             'type_invoice' => '01',
    //             'shipping_method' => 1,
    //             'pickup_store' => 1,
    //             'state' => 1,
    //             'order_detail' => array( 
    //                 array('id_product' => 3, 'quantity' => 1, 'unit_price' => 10,'total_price' => 10),
    //                 array('id_product' => 4, 'quantity' => 1, 'unit_price' => 10,'total_price' => 10),
    //             ),
    //         ],['token' => '$2y$10$ODNS1ZL8qO6gHJO1sHDwK.7WzNaZ6SmnOzxVE4JX09hximt3TlrqG'])
    //         ->seeJson([
    //             'status' => 201,
    //         ]);

    // }

    
    // ///LISTAR PEDIDO POR CLIENTE
    // public function testListOrdeByClient()
    // {
    //     $this->json('get', '/test/order-list/8',[])
    //         ->seeJson([
    //             'status' => 200,
    //         ]);
    // }


    // ///REGISTRAR VENTA
    

    // ///REGISTRAR COMPRA
    // public function testRegisterShopping()
    // {
    //     $this->json('post', '/test/shopping-add',[
    //             'id_provider' => 1,'id_user' =>1,
    //             'id_user' => 1, 'id_warehouse' => 1,
    //             'linkages' => array(),'operation_type' => '02',
    //             'invoice_type' => '01', 'serie' => 'F001',
    //             'number' => '00414852','broadcast_date' => date('Y-m-d'),
    //             'arrival_date' => date('Y-m-d'),'coin' => 'PEN',
    //             'exchange_rate' => 1, 'way_to_pay' => '01-008',
    //             'affection_for_detraction' => '1', 'unit_value' => '0',
    //             'expenses' => 0,'observation' => '', 'taxed_operation' => 400,
    //             'exonerated_operation' => 0, 'unaffected_operation' => 0,
    //             'discount' => 0,'subtotal' => 400,
    //             'igv' => 72,'total' => 472, 'state' => 1,
    //             'shopping_detail' => array( 
    //                 array('id_product' => 10, 'coin' => 'PEN', 'exchange_rate' => 1, 'quantity' => 2, 'package' => 1, 'percentage_discount' => 0, 'unit_value' => 100,'unit_discount' => 0,
    //                 'net_unit_value' => 100,'unit_igv' => 18,'unit_price' => 118,'total_value' => 200,'total_discount' => 0,'net_total_value' => 200,'total_igv' => 36,'total_price' => 236),
    //             ),
    //         ],['token' => '$2y$10$ODNS1ZL8qO6gHJO1sHDwK.7WzNaZ6SmnOzxVE4JX09hximt3TlrqG'])
    //         ->seeJson([
    //             'status' => 201,
    //         ]);

    // }



}

