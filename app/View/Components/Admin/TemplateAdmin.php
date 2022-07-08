<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class TemplateAdmin extends Component
{

    public $title;
    public $menuUtama;
    public $menuKedua;

    public function __construct($title,$menuUtama,$menuKedua)
    {
        $this->title = $title;
        $this->menuUtama = $menuUtama;
        $this->menuKedua = $menuKedua;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.admin.template-admin');
    }
}
