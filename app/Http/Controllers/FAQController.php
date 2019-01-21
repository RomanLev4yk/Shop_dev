<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Model\FAQ;

class FAQController extends Controller
{
  public function item(int $id, Request $request) : JsonResponse
  {
    try {
      $model = FAQ::findOrFail($id);
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
    $model = new FAQ;
    try {
      $model = $model->fill([
        'question'=>$request->input('question'),
        'answer'=>$request->input('answer')
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
      $all = FAQ::select('id', 'question', 'answer');
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
      'question' => 'string|max:255|min:1|nullable',
      'answer' => 'string|max:255|nullable'
    ]);

    try {
      $model = FAQ::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    try {
      $model = $model->fill($request->only('question', 'answer')
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
      FAQ::destroy($id);
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
      $q = $q->where('question', 'like', '%' . $params['query'] . '%')
          ->orwhere('answer', 'like', '%' . $params['query'] . '%');
    }
    return parent::setParamsBeforeQuery($q, $params);
  }
}
