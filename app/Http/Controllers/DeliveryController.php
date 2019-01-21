<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Model\Delivery;

class DeliveryController extends Controller
{
  public function item(int $id, Request $request) : JsonResponse
  {
    try {
      $model = Delivery::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    return response()->json([
      'status'=>true,
      'message'=>__('responses.item_success'),
      'model'=>$model,], 200);
  }


  public function create(Request $request) : JsonResponse
  {
    $model = new Delivery;
    try {
      $model = $model->fill([
        'name'=>$request->input('name'),
        'description'=>$request->input('description'),
        'cost'=>$request->input('cost')
      ]);
      $model->save();
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }
    return response()->json([
      'status'=>true,
      'message'=>__('responses.create_successful'),
      'model'=>$model ], 200);
  }



  public function collection(Request $request) : JsonResponse
  {
    $params = $request->all();

    try {
      $all = Delivery::select('id', 'name', 'description', 'cost');
      $all = $this->setPaginationQuery($all, $params)->get();

    } catch (\Exception $err) {
      logger( $err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>[] ], 422);
    }
    return response()->json([
      'status'=>true,
      'message'=>__('responses.collection_successful'),
      'collection'=>$all ], 200);
  }




  public function update(int $id, Request $request) : JsonResponse
  {
    // unique:categories|
    $request->validate([
      'name' => 'string|required|max:255|min:1',
      'description' => 'max:255',
      'cost' => ''
    ]);

    try {
      $model = Delivery::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    try {
      $model = $model->fill($request->only('name', 'description', 'cost')
      //   [
      //   'name'=>$request->input('name'),
      //   'description'=>$request->input('description') ?? $model->description
      // ]
    );
      $model->save();
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }
    return response()->json([
      'status'=>true,
      'message'=>__('responses.update_successful'),
      'collection'=>$model ], 200);
  }

  public function delete(int $id, Request $request) : JsonResponse
  {
    try {
      Delivery::destroy($id);
    } catch (\Exception $err) {
      logger($err ->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }
    return response()->json([
      'status'=>true,
      'message'=>__('responses.delete_successful'),
      'model'=>null ], 200);
  }


  public function setParamsBeforeQuery($q, array $params)
  {
    if (isset($params['query'])) {
      $q = $q->where('name', 'like', '%' . $params['query'] . '%')
          ->orwhere('description', 'like', '%' . $params['query'] . '%')
          ->orwhere('cost', 'like', '%' . $params['query'] . '%');
    }
    return parent::setParamsBeforeQuery($q, $params);
  }
}
