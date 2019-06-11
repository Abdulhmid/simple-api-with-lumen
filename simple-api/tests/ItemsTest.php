<?php

class ItemsTest extends TestCase
{
    /**
     * /items [GET]
     */
    public function testShouldReturnAllItems(){

        $this->get("items", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'data' => ['*' =>
                [
                    'item_name',
                    'item_description',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ],
            'meta' => [
                '*' => [
                    'total',
                    'count',
                    'per_page',
                    'current_page',
                    'total_pages',
                    'links',
                ]
            ]
        ]);
        
    }

    /**
     * /items/id [GET]
     */
    public function testShouldReturnItems(){
        $this->get("items/2", []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'item_name',
                    'item_description',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ]    
        );
        
    }

    /**
     * /items [POST]
     */
    public function testShouldCreateItems(){

        $parameters = [
            'item_name' => 'Infinix',
            'item_description' => 'NOTE 4 5.7-Inch IPS LCD',
        ];

        $this->post("items", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'item_name',
                    'item_description',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ]    
        );
        
    }
    
    /**
     * /items/id [PUT]
     */
    public function testShouldUpdateItems(){

        $parameters = [
            'item_name' => 'Infinix Hot Note',
            'item_description' => 'Champagne Gold, 13M AF + 8M FF 4G Smartphone',
        ];

        $this->put("items/21", $parameters, []);
        $this->seeStatusCode(200);
        $this->seeJsonStructure(
            ['data' =>
                [
                    'item_name',
                    'item_description',
                    'created_at',
                    'updated_at',
                    'links'
                ]
            ]    
        );
    }

    /**
     * /items/id [DELETE]
     */
    public function testShouldDeleteItems(){
        
        $this->delete("items/3", [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
                'status',
                'message'
        ]);
    }

}