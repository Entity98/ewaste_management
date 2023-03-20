<?php

namespace App\Http\Livewire\Admin;

use App\Http\Livewire\CategoryComponent;
use App\Models\Category;
use Illuminate\Contracts\Session\Session;
use Livewire\Component;
use Livewire\WithPagination;

class AdminCategoryComponent extends Component
{
    use WithPagination;

    public function deleteCategory($id){
        $category = Category::find($id);
        $category->delete();
        Session()->flash('message','Category has been deleted successfully!');
    }

    public function render()
    {
        $categories = Category::paginate(5);
        return view('livewire.admin.admin-category-component',['categories'=>$categories])->layout('layouts.base');
    }
}
