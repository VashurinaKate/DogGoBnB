<?php

declare(strict_types=1);

namespace App\Queries;

use Illuminate\Contracts\Database\Eloquent\Builder;

interface QueryBuilder
{
  public function getBuilder(): Builder;
}