<?php

namespace App\Http\Controllers;

use App\Transactions;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\TransTransformer;

class TransactionController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    private $fractal;

    public function __construct()
    {
        $this->fractal = new Manager();  
    }
    /**
     * GET /products
     * 
     * @return array
     */
    public function store(Request $request){
        $this->validate($request, [
            'item_id' => 'required',
            'qty' => 'integer|required',
            'price' => 'integer|required',
        ]);

        $input = $request->all();
        $input['total'] = $request['qty'] * $request['price'];
        $trans = Transactions::create($input);
        $resource = new Item($trans, new TransTransformer);
        return $this->fractal->createData($resource)->toArray();
    }

}