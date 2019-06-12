<?php
namespace App\Transformers;

use App\Transactions;
use League\Fractal;

class TransTransformer extends Fractal\TransformerAbstract
{
	public function transform(Transactions $trans)
	{
	    return [
	        'id'      => (int) $trans->id,
	        'item_id'   => $trans->item_id,
	        'qty'    =>  $trans->qty,
	        'total'    =>  $trans->total,
	        'created_at'    =>  $trans->created_at->format('d-m-Y'),
	        'updated_at'    =>  $trans->updated_at->format('d-m-Y'),
            'links'   => [
                [
                    'uri' => 'transaction/'.$trans->id,
                ]
            ],
	    ];
	}
}