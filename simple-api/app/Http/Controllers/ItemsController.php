<?php

namespace App\Http\Controllers;

use App\Items;
use Illuminate\Http\Request;
use League\Fractal;
use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\ItemsTransformer;

class ItemsController extends Controller
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
    public function index(){
        $paginator = Items::paginate();
        $products = $paginator->getCollection();
        $resource = new Collection($products, new ItemsTransformer);
        $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));
        return $this->fractal->createData($resource)->toArray();
    }

    public function show($id){
        $items = Items::find($id);
        $resource = new Item($items, new ItemsTransformer);
        return $this->fractal->createData($resource)->toArray();
    }

    public function store(Request $request){

        //validate request parameters
        $this->validate($request, [
            'product_name' => 'bail|required|max:255',
            'product_description' => 'bail|required',
        ]);

        $items = Items::create($request->all());
        $resource = new Item($items, new ItemsTransformer);
        return $this->fractal->createData($resource)->toArray();
    }

    public function update($id, Request $request){

        //validate request parameters
        $this->validate($request, [
            'product_name' => 'max:255',
        ]);

        //Return error 404 response if items was not found
        if(!Items::find($id)) return $this->errorResponse('items not found!', 404);

        $items = Items::find($id)->update($request->all());

        if($items){
            //return updated data
            $resource = new Item(Items::find($id), new ItemsTransformer); 
            return $this->fractal->createData($resource)->toArray();
        }

        //Return error 400 response if updated was not successful        
        return $this->errorResponse('Failed to update items!', 400);
    }

    public function destroy($id){
        
        //Return error 404 response if items was not found
        if(!Items::find($id)) return $this->errorResponse('Items not found!', 404);

        //Return 410(done) success response if delete was successful
        if(Items::find($id)->delete()){
            return $this->customResponse('Items deleted successfully!', 410);
        }

        //Return error 400 response if delete was not successful
        return $this->errorResponse('Failed to delete items!', 400);
    }

    public function customResponse($message = 'success', $status = 200)
    {
        return response(['status' =>  $status, 'message' => $message], $status);
    }
}