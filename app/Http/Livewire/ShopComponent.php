<?php

namespace App\Http\Livewire;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;
use Cart;
use App\Models\Category;

class ShopComponent extends Component
{
    public $sorting;
    public $pagesize;
    public function mount()
    {
        $this->sorting = "default";
        $this->pagesize = "12";
    }
    public function store($product_id, $product_name, $product_price)
    {
        Cart::add($product_id, $product_name, 1, $product_price)->associate('App\Models\Product');
        session()->flash('success_message','Item added in Cart');
        return redirect()->route('product.cart');
    }
    use WithPagination;
    public function render()
    {
        if($this->sorting=='date')
        {
            $products = Product::orderby('created_at', 'DESC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price')
        {
            $products = Product::orderby('regular_price', 'ASC')->paginate($this->pagesize);
        }
        else if($this->sorting=='price-desc')
        {
            $products = Product::orderby('regular_price', 'DESC')->paginate($this->pagesize);
        }
        else{
            $products = Product::paginate($this->pagesize);
        }

        $categories = Category::all();

        $popular_products = Product::inRandomOrder()->limit(4)->get();
        return view('livewire.shop-component',['product'=>$products, 'popular_products'=>$popular_products,'categories'=>$categories])->layout('layouts.base');
    }
}
