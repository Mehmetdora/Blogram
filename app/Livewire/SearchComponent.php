<?php

namespace App\Livewire;

use App\Models\Blog;
use App\Models\User;
use Livewire\Component;
use App\Models\Category;

class SearchComponent extends Component
{
    public $search = '';

    public function render()
    {


        // Blog arama
        $resultsBlog = Blog::where('status', 1)
        ->where('title', 'like', '%' . $this->search . '%')
        ->take(3)  // Max 3 blog göster
        ->get();

        // User arama
        $resultsUser = User::where('status', 0)
        ->where('name', 'like', '%' . $this->search . '%')
        ->take(3)  // Max 3 kullanıcı göster
        ->get();

        // Kategori arama
        $resultsCategory = Category::where('status', 1)
        ->where('name', 'like', '%' . $this->search . '%')
        ->take(3)  // Max 3 kategori göster
        ->get();

        return view('livewire.search-component', [
            'people' => $resultsUser,
            'blogs' => $resultsBlog,
            'categories' => $resultsCategory,

        ]);
    }
}
