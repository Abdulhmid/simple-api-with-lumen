<?php

use App\Items;

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
     * /items/id [GET]
     */
    public function testShouldReturnItems(){
        $item = Items::first();
        $this->get("items/".$item->id, []);
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
        $item = Items::first();
        $parameters = [
            'item_name' => 'Infinix Hot Note',
            'item_description' => 'Champagne Gold, 13M AF + 8M FF 4G Smartphone',
        ];

        $this->put("items/".$item->id, $parameters, []);
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
        $item = Items::first();
        $this->delete("items/".$item->id, [], []);
        $this->seeStatusCode(410);
        $this->seeJsonStructure([
                'status',
                'message'
        ]);
    }

}