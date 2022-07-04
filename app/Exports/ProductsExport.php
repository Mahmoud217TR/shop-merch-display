<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductsExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Product::with('category')->get()->map(function($product){
            return [
                'id' => $product->id,
                'category' => $product->category->name,
                'name' => $product->name,
                'price' => $product->price,
            ];
        });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Category',
            'Name',
            'Price',
        ];
    }
}
