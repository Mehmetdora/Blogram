<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class CategorySearchComponent extends Component
{
    public $search_category;

    public $all_categories;

    public function mount($all_categories){
        $this->all_categories = $all_categories;
    }

    public function render()
    {

        // Kategori arama
        $resultsCategories = Category::where('status', 1)
        ->where('name', 'like', '%' . $this->search_category . '%')
        ->take(5)
        ->get();


        return view('livewire.category-search-component',[
            'result_categories' => $resultsCategories,
            'all_categories' => $this->all_categories,
            'search_category' => $this->search_category
        ]);
    }
}
