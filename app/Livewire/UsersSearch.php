<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class UsersSearch extends Component
{
    public $search = '';
    public $users_all = [];

    public function render()
    {

         // User arama
         $resultsUser = User::where('status', 0)
         ->where('is_delete',0)
         ->where('is_admin',0)
         ->whereHas('profile')
         ->where('name', 'like', '%' . $this->search . '%')
         ->take(5)  // Max 3 kullanıcı göster
         ->get();



         return view('livewire.users-search', [
             'users' => $resultsUser

         ]);
    }
}
