<?php

namespace App\Http\Responses\Api\Admin;

class Users extends ListBase
{
    protected static $itemsResponseModel = User::class;
}
