<?php
namespace App\Http\Requests\Api\Admin;

use LaravelRocket\Foundation\Http\Requests\Traits\PaginationTrait;

class PaginationRequest extends Request
{
    use PaginationTrait;
}
