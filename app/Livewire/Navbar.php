<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;

class Navbar extends Component
{
    public function render()
    {
        $navCategories = Category::all();

        return view('livewire.nav-bar', compact('navCategories'));
    }
}
