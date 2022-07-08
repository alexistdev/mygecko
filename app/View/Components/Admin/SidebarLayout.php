<?php

namespace App\View\Components\Admin;

use Illuminate\View\Component;

class SidebarLayout extends Component
{
    public $menuUtama;
    public $menuKedua;

    public function __construct($menuUtama,$menuKedua)
    {
        $this->menuUtama = $menuUtama;
        $this->menuKedua = $menuKedua;
    }

    public function render()
    {
        return view('components.admin.sidebar-layout');
    }
}
