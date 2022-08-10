<?php

declare(strict_types=1);

namespace App\Queries;

use App\Models\User;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Pagination\LengthAwarePaginator;

class QueryBuilderSitters implements QueryBuilder
{

	public function getBuilder(): Builder
	{
		return User::query();
	}

	public function getSiters(int $locations)
	{
		return User::select([ 'name', 'description', 'locations','phone'])
		->WHERE('locations',$locations);
	}

	
}