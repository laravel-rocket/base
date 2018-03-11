<?php
namespace App\Http\Requests\Api\V1;

use LaravelRocket\Foundation\Http\Requests\Traits\PaginationTrait;

class PaginationRequest extends Request
{
    use PaginationTrait;
}
