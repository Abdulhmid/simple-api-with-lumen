<?php

class TransactionTest extends TestCase
{
    /**
     * /transaction [POST]
     */
    public function testShouldCreateTransaction(){

        $parameters = [
            'item_id' => 1,
            'qty'     => 2,
            'price'   => 2000,
        ];

        $this->post("transaction", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'item_id',
                    'item_id',
                    'qty',
                    'total',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ]    
        );
        
    }

}