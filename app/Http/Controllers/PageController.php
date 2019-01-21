<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

use App\Model\Page;
use App\Model\Setting;
use App\Model\Currency;
use App\Model\Payment;
use App\Model\Menu;

class PageController extends Controller
{
  public function client (Request $request)
  {
    $path = $request->path();

    try {
        $model = Page::select('title', 'description', 'content', 'url', 'view')
              ->where('url', $path)
              ->firstOrFail();
    } catch (\Exception $err) {
        abort('404');
    }
    $viewClass = $this->buildViewClassPath($model->view);

    return view($model->view, array_merge([
        'page' => $model,
        'preview' => function ($img, $width, $height) {
          return preview($img, $width, $height);
        },
        'socials' => Setting::getDataByDescription('socials_icon'),
        'currencies' => Currency::getAllAvailableCurrencies(),
        'paymentSystem' => Payment::getAllAvailablePaymentsIcons(),
        'menu' => Menu::getItems()
      ], (new $viewClass($model))->toArray()));
  }

  public function item(int $id, Request $request) : JsonResponse
  {
    try {
      $model = Page::findOrFail($id);
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
    $model = new Page;
    try {
      $model = $model->fill([
        'url'=>$request->input('url'),
        'title'=>$request->input('title'),
        'description'=>$request->input('description'),
        'content'=>$request->input('content')
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
      $all = Page::select('id', 'url', 'title', 'description', 'content');
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
      'url' => 'string|required|url',
      'title' => 'string|max:255',
      'description' => 'string|max:255',
      'content' => 'string'
    ]);

    try {
      $model = Page::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    try {
      $model = $model->fill($request->only('url', 'title', 'description', 'content'));
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
      Page::destroy($id);
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
      $q = $q->where('url', 'like', '%' . $params['query'] . '%')
          ->orwhere('title', 'like', '%' . $params['query'] . '%')
          ->orwhere('description', 'like', '%' . $params['query'] . '%')
          ->orwhere('content', 'like', '%' . $params['query'] . '%');
    }
    return parent::setParamsBeforeQuery($q, $params);
  }
}
