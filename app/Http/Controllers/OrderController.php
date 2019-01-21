<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\EmailValidate;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

use App\Model\Order;

class OrderController extends Controller
{
  public function item(int $id, Request $request) : JsonResponse
  {
    $select = json_decode($request->input('select')) ?? [];

    if (!isset($select['id'])) {
			array_push($select, 'id');
		}

		if (!isset($select['number'])) {
			array_push($select, 'number');
		}

    try {
      $model = Order::select($select);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }
     $model = $model->with('products')
                    ->with('deliveries')
                    ->with('payments')
                    ->with('status');
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
        try {
          $request->validate([
            'user_id' => 'required|integer',
            'order_delivery_id' => 'required|integer',
            'payment_id' => 'required|integer',
            'products' => 'required|json',
            'deliveries' => 'required|json',
            'payments' => 'required|json'
            ]);
        }
        catch(\Exception $err) {
          logger($err->getMessage());
          return response()->json([
            'status'=> false,
            'message' => __('responses.invalid_format'),
            'model'=>null], 422);
        }

        $deliveriesData = json_decode($request->input('deliveries'));
        try {

          $this->validateEmail($deliveriesData->user_email);

        } catch (\Exception $err) {
          logger($err->getMessage());
          return response()->json([
            'status'=> false,
            'message' => __('responses.validate_email'),
            'model'=>null], 422);
        }


        return DB::transaction(function() use($request) {

          $model = new Order;

          try {

            $model->fill($productParams = $request->only(
              'user_id',
              'order_delivery_id',
              'payment_id'
            ));

          }
          catch(\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.fill_failure'),
              'model'=>null], 422);
          }

          try {

            $model->save();

          }
          catch(\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.save_failure_one'),
              'model'=>null], 422);
          }


          try {

                $model->setCarts(json_decode($request->input('products')) ?? []);

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.carts_failure'),
              'model'=>null], 422);
          }


          try {

                $model->setDeliveries($deliveriesData ?? []);

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.deliveries_failure'),
              'model'=>null], 422);
          }

          try {

                $model->setPayments($request->input('payment_id'));

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.payments_failure'),
              'model'=>null], 422);
          }

          try {

                $model->setNumber();

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.number_failure'),
              'model'=>null], 422);
          }


          try {

                $model->setCost();

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.cost_failure'),
              'model'=>null], 422);
          }

          try {

                $model->setDefaultStatus();

          } catch (\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.status_failure'),
              'model'=>null], 422);
          }

          try {

                $model->save();

          }
          catch(\Exception $err) {
            logger($err->getMessage());
            return response()->json([
              'status'=> false,
              'message' => __('responses.save_failure'),
              'model'=>null], 422);
          }


          return response()->json([
            'status'=> true,
            'message' => __('responses.create_successful'),
            'model'=> $model], 200);
      });
  }



  public function collection(Request $request) : JsonResponse
  {
    $params = $request->all();

    try {
      $all = Order::select(
        'id',
        'user_id',
        'order_delivery_id',
        'payment_id')
        ->with('products')
        ->with('deliveries')
        ->with('payments')
        ->with('status');
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
    try {
      $request->validate([
        'user_id' => 'integer',
        'order_delivery_id' => 'integer',
        'payment_id' => 'integer',
        'products' => 'json',
        'deliveries' => 'json',
        'payments' => 'json'
      ]);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => __('responses.invalid_format'),
        'model'=>null], 422);
    }

    print_r($request);
    exit();
    return DB::transaction(function () use($request) {

      try {
        $model = Order::findOrFail($id);
      } catch (\Exception $err) {
        logger($err->getMessage());

        return response()->json([
          'status'=> false,
          'message' => __('responses.search_failed'),
          'model'=>null], 422);
      }
      try {
        $model = $model->fill($request->only('user_id', 'order_delivery_id', 'payment_id'));

        $model->products()->where('order_id', $model->id)->update($request->products);
        $model->deliveries()->where('id', $model->id)->update($request->deliveries);
        $model->payments()->where('id', $model->id)->update($request->payments);

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
    });
  }

  public function delete(int $id, Request $request) : JsonResponse
  {
    return DB::transaction(function () use($id) {
      $model = Order::findOrFail($id);
      try {
        $model->products()->delete();
        $model->deliveries()->delete();
        $model->payments()->delete();
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
      $q = $q->where('user_id', 'like', '%' . $params['query'] . '%')
      ->orwhere('order_delivery_id', 'like', '%' . $params['query'] . '%')
      ->orwhere('payment_id', 'like', '%' . $params['query'] . '%');

    }
    return parent::setParamsBeforeQuery($q, $params);
  }
}
