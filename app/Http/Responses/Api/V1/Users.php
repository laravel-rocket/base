<?php
namespace App\Http\Responses\Api\V1;

class Users extends ListBase
{
    protected static $itemsResponseModel = User::class;
}
