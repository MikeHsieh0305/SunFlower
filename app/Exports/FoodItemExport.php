<?php

namespace App\Exports;

use App\Models\FoodItem;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;

class FoodItemExport implements FromCollection
{
    //use Exportable;
    public function collection()
    {
        //return FoodItem::all();
        return FoodItem::join('food__categories', 'food_items.ItemCategory', '=', 'food__categories.id')->
            select('food_items.name as Name', 'Quantity', 'Unit_Price', 'remark', 'food__categories.description as ItemCategory')->get();
    }
    // public function query()
    // {
    //     return FoodItem::query()->whereKey($this->id);
    // }

   
}
