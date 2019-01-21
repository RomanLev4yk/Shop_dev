<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Model\Product;


class ProductController extends Controller
{
  public function item(int $id, Request $request) : JsonResponse
  {
    $select = json_decode($request->input('select')) ?? [];

    if (!isset($select['id'])) {
			array_push($select, 'id');
		}

		if (!isset($select['articul'])) {
			array_push($select, 'articul');
		}

    try {
      $model = Product::select($select);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' =>  __('responses.invalid_request_select'),
        'model'=>null], 422);
    }

    $model = $model->with('images')
                   ->with('videos')
                   ->with('categories')
                   ->with('collections')
                   ->with('properties')
                   ->with('vendor')
                   ->with('orders');

     try {
       $model = $model->findOrFail($id);
     } catch (\Exception $err) {
       logger($err->getMessage());
       return response()->json([
         'status'=> false,
         'message' => __('responses.search_failed'),
         'model'=>null], 422);
      }

    return response()->json([
      'status'=>true,
      'message'=>__('responses.item_success'),
      'model'=>$model,], 200);
  }


  public function create(Request $request) : JsonResponse
  {
      try{
          $request->validate([
              'images' => 'json',
              'videos' => 'json',
              'collections' => 'json',
              'properties' => 'json',
              'categories' => 'json',
              'name' => 'required|string|max:255',
              'articul' => 'required|string|unique:products|max:255',
              'description' => 'string|max:255',
              'cost' => 'numeric|required|min:0',
              'page_id' => 'integer',
              'vendor_id' => 'integer',
              'currency_id' => 'integer'
          ]);
      } catch (\Exception $err) {
          return response()->json([
              'status'=> false,
              'message' => __('responses.invalid_format'),
              'model'=>null], 422);
      }

      return DB::transaction(function () use($request) {
          $model = new Product;

          $model->fill($productParams = $request->only(
              'name',
              'articul',
              'description',
              'cost',
              'page_id',
              'currency_id',
              'vendor_id'
          ));
          $model->save();


          try {
              $model->setSimpleDefaultModels('App\Model\ProductVideo', 'video_id', json_decode($request->input('videos')) ?? []);
          } catch (\Exception $err) {
              return response()->json([
                  'status'=> false,
                  'message' => $err->getMessage(). __LINE__,
                  'model'=>null], 422);
          }

          try {
              $model->setSimpleDefaultModels('App\Model\ProductImage', 'image_id', json_decode($request->input('images')) ?? []);
          } catch (\Exception $err) {
              return response()->json([
                  'status'=> false,
                  'message' => $err->getMessage(). __LINE__,
                  'model'=>null], 422);
          }


          try {
              $model->setSimpleDefaultModels('App\Model\ProductCollection', 'collection_id', json_decode($request->input('collections')) ?? []);
          } catch (\Exception $err) {
              return response()->json([
                  'status'=> false,
                  'message' => $err->getMessage(). __LINE__,
                  'model'=>null], 422);
          }

          try {
              $model->setSimpleDefaultModels('App\Model\ProductCategory', 'category_id', json_decode($request->input('categories')) ?? []);
          } catch (\Exception $err) {
              return response()->json([
                  'status'=> false,
                  'message' => $err->getMessage(). __LINE__,
                  'model'=>null], 422);
          }

          try {
            $model->setProperties(json_decode($request->input('properties')) ?? []);
          } catch (\Exception $err) {
              return response()->json([
                  'status'=> false,
                  'message' => $err->getMessage(). __LINE__,
                  'model'=>null ], 422);
          }

          return response()->json([
                  'status' => true,
                  'message' => __('responses.create_successful'),
                  'model' => $model ], 200);
      });
  }



  public function collection(Request $request) : JsonResponse
  {
    $params = $request->all();
    try {
      $all = Product::select(
        'id',
        'name',
        'articul',
        'description',
        'cost',
        'page_id',
        'currency_id',
        'vendor_id')
        ->with('images')
        ->with('videos')
        ->with('categories')
        ->with('collections')
        ->with('properties')
        ->with('vendor')
        ->with('orders');
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
    $request->validate([
      'name' => 'string|max:255|required',
      'articul' => 'string|max:255|required',
      'description' => 'string|max:255|nullable',
      'cost' => 'max:12',
      'page_id' => 'integer',
      'currency_id' => 'integer',
      'vendor_id' => 'integer'
    ]);

    try {
      $model = Product::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    try {
      $model = $model->fill($request->only('name', 'articul', 'description', 'cost', 'page_id', 'currency_id', 'vendor_id'));
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
    return DB::transaction(function () use($id) {
      $model = Product::findOrFail($id);
      try {
        $model->images()->delete();
        $model->videos()->delete();
        $model->categories()->delete();
        $model->collections()->delete();
        $model->properties()->delete();
        $model->vendor()->delete();
        //????????? необходимо ли это удаление
        $model->orders()->delete();
        $model->delete();
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
    });
  }


  public function setParamsBeforeQuery($q, array $params)
  {
    if (isset($params['query'])) {
      $q = $q->where('name', 'like', '%' . $params['query'] . '%')
      ->orwhere('articul', 'like', '%' . $params['query'] . '%')
      ->orwhere('description', 'like', '%' . $params['query'] . '%')
      ->orwhere('cost', 'like', '%' . $params['query'] . '%')
      ->orwhere('page_id', 'like', '%' . $params['query'] . '%')
      ->orwhere('currency_id', 'like', '%' . $params['query'] . '%')
      ->orwhere('vendor_id', 'like', '%' . $params['query'] . '%');

    }
    return parent::setParamsBeforeQuery($q, $params);
  }
}
