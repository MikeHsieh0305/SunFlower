<?php
namespace App\Http\Controllers;
use App\Exports\FoodItemExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\FoodItem;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Models\Food_Category;
use Termwind\Components\Raw;

class FoodItemController extends Controller
{
    // public function index()
    // {
    //     $FoodItems = FoodItem::all()->sortByDesc('id')->toArray();
    //     return array_reverse($FoodItems);      
    // }
    // public function store(Request $request)
    // {
    //     $FoodItem = new FoodItem([
    //         'Name' => $request->input('Name'),
    //         'Quantity' => $request->input('Quantity'),
    //         'Unit_Price' => $request->input('Unit_Price'),
    //         'ItemCategory' => $request->input('ItemCategory'),
    //         'remark' => $request->input('remark')
    //     ]);
    //     $FoodItem->save();
    //     return response()->json('FoodItem created!');
    // }
    // public function show($id)
    // {
    //     $FoodItem = FoodItem::find($id);
    //     //$FoodItem = FoodItem::where('Food_ID',$id)->firstOrFail();
    //     return response()->json($FoodItem);
    // }
    // public function update($id, Request $request)
    // {
    //     $FoodItem = FoodItem::find($id);
    //     //$FoodItem = FoodItem::where('Food_ID',$id);
    //     $FoodItem->update($request->all());
    //     return response()->json('FoodItem updated!');
    // }
    // public function destroy($id)
    // {
    //     $FoodItem = FoodItem::find($id);
    //     //$FoodItem = FoodItem::where('Food_ID',$id);
    //     $FoodItem->delete();
    //     return response()->json('FoodItem deleted!');
    // }
   
    public function index()
    {

        $query = FoodItem::join('food__categories', 'food_items.ItemCategory', '=', 'food__categories.id')->
            select('food_items.id', 'food_items.name as Name', 'Quantity', 'Unit_Price', 'remark', 'food__categories.description as ItemCategory')->get();
        
        //return DB::statement('select id, name, Quantity, Unit_price, remark, (select id from food__categories where id = a.ItemCategory) from Food_items a');
        return ProductResource::collection($query);
    }

    

    public function store(ProductRequest $request)
    {
        $product = FoodItem::create($request->validated());

        return new ProductResource($product);
    }

    public function show(FoodItem $product)
    {
        return new ProductResource($product);
    }

    public function update(ProductRequest $request, FoodItem $product)
    {
        $product->update($request->validated());

        return new ProductResource($product);
    }

    public function destroy(FoodItem $product)
    {
        $product->delete();

        return response()->noContent();
    }

    // public function export($FoodItem){
    //     $products = explode(',', $FoodItem);
    //     return (new FoodItemExport)->download('products.xlsx');
    // }

    public function export() 
    {
        return Excel::download(new FoodItemexport, 'Products.xlsx');
    }
}
