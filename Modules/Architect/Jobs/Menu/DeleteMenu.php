<?php

namespace Modules\Architect\Jobs\Menu;

use Modules\Architect\Http\Requests\Menu\DeleteMenuRequest;
use Modules\Architect\Entities\Menu;

use Illuminate\Support\Facades\Schema;

class DeleteMenu
{
    public function __construct(Menu $menu)
    {
        $this->Menu = $menu;
    }

    public static function fromRequest(Menu $menu, DeleteMenuRequest $request)
    {
        return new self($menu);
    }

    public function handle()
    {
        Schema::disableForeignKeyConstraints();
        $result = $this->Menu->delete();
        Schema::enableForeignKeyConstraints();

        return $result;
    }
}
