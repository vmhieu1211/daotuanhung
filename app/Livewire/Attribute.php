<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Features\SupportAttributes\AttributeCollection;

class Attribute extends Component
{
    public AttributeCollection $attributes;

    public function mount()
    {
        $this->attributes = new AttributeCollection();
    }

    public function increment()
    {
        $this->attributes[] = count($this->attributes) + 1;
    }

    public function decrement($index)
    {
        unset($this->attributes[$index]);
    }

    public function render()
    {
        return view('livewire.attribute');
    }
}
