<?php

namespace App\View\Components\forms;

use App\Models\Client;
use Illuminate\View\Component;

class profile extends Component {
    public bool $editMode;
    public Client $data;
    
    public function __construct(Client $data = null, $editMode=false) {
        $this->editMode = $editMode;
        //$this->title = $editMode ? "Modifier":"Créer";
        $this->data = $data;
        return $this;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.forms.profile');
    }
}
