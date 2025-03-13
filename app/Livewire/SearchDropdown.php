<?php

namespace App\Livewire;

use App\Models\Product;
use Livewire\Component;
use App\Models\SystemSetting;

class SearchDropdown extends Component
{
    public $search = '';

    public function render()
    {
        $searchResults = [];

        if (strlen($this->search) > 2) {

            $searchResults = Product::with('category')->where('name', 'like', '%' . $this->search . '%')->get();
        }

        $searchResults = collect($searchResults)->take(7);

        $systemName = SystemSetting::first();

        return view('livewire.search-dropdown', compact('searchResults', 'systemName'));
    }
}
