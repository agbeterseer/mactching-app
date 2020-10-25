<?php

namespace App\Services;
 
use App\Transaction;
use App\Repositories\Repository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session; 
use Carbon\Carbon;
use DB;
use Auth;

class TransactionService
{
	protected $model;
	
	public function __construct(Transaction $transactionModel)
	{
	$this->model = new Repository($pfaModel);
	}
 
	public function all()
	{
	return $this->model->all();
	}
 
	public function create(Request $request)
	{
	$attributes = $request->all();

	return $this->model->create($attributes);
	}

	public function show($id)
	{
     return $this->model->show($id);
	}
 
 	public function read($id)
	{
     return $this->model->find($id);
	}
 
	public function update(Request $request, $id)
	{
	  $attributes = $request->all();
	  
      return $this->model->update($id, $attributes);
	}
 
	 
 
}