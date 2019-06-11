<?php
namespace App\Transformers;

use App\Items;
use League\Fractal;

class ItemsTransformer extends Fractal\TransformerAbstract
{
	public function transform(Items $item)
	{
	    return [
	        'id'      => (int) $item->id,
	        'product_name'   => $item->item_name,
	        'product_description'    =>  $item->item_description,
	        'created_at'    =>  $item->created_at->format('d-m-Y'),
	        'updated_at'    =>  $item->updated_at->format('d-m-Y'),
            'links'   => [
                [
                    'uri' => 'items/'.$item->id,
                ]
            ],
	    ];
	}
}