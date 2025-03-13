<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\SystemSetting;

class FooterDetail extends Component
{
    public function render()
    {
        $systemDetail = SystemSetting::first();
        return view('livewire.footer-detail', compact('systemDetail'));
    }
}
