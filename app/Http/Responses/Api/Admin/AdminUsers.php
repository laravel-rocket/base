<?php

namespace App\Http\Responses\Api\Admin;

class AdminUsers extends ListBase
{
    protected static $itemsResponseModel = AdminUser::class;
}
