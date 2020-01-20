<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Message\StoreRequest;
use App\Models\Message;
use App\Services\MessageService;
use Illuminate\Support\Facades\DB;
class MessageController extends Controller
{
  protected $messageService;

  public function __construct(MessageService $messageService)
  {
    $this->middleware('auth');
    $this->messageService = $messageService;
  }

  /**
   * @param StoreRequest $request
   * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
   * @throws \Exception
   */
  public function store(StoreRequest $request)
  {
    $data = $request->all();

    DB::beginTransaction();
    try{
      $apply = $this->messageService->store($data);
      DB::commit();
    }catch(\Exception $exception){
      DB::rollback();
      throw $exception;
    }
    return response($apply, 201);
  }

  /**
   * @param int $customerId
   * @return mixed
   */
  public function showApplyOnlyHasMessage(int $customerId)
  {
    return $this->messageService->appliesByOwnerOnlyHasMessage($customerId);
  }
  /**
   * @param int $customerId
   * @return mixed
   */
  public function showAppliedOnlyHasMessage(int $customerId)
  {
    return $this->messageService->appliedByOwnerOnlyHasMessage($customerId);
  }

}