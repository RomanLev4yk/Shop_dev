<?php

namespace App\Model;
use App\Events\CreateNewOrderEvent;

class Order extends XModel
{
    protected $productsCached = [];
    protected $currentProducts = [];
    protected $currentDelivery = null;
    protected $currentPayment = null;
    protected $quarded = [ 'number' ];

    public function products ()
    {
      return $this->hasMany(ProductOrder::class);
    }
    public function deliveries ()
    {
      return $this->hasOne(OrderDelivery::class, 'delivery_id');
    }
    public function payments ()
    {
      return $this->hasOne(OrderPayment::class, 'payment_id');
    }
    public function status ()
    {
      return $this->hasOne(OrderStatus::class, 'id');
    }

    public function defineProduct (int $id) : Product
    {
      if ($this->productsCached[$id]) {
        return $this->productsCached[$id];
      }
      try {
        $product = Product::findOrFail($id);
      } catch (\Exception $err) {
        logger($err->getMessage());
        return null;
      }
      return ($this->productsCached[$id] = $product);
    }

    public function setCarts (array $products = []) : array
    {
        for ($i = 0; $i < count($products); $i++)
        {
            $product = $this->defineProduct($products[$i]->product_id);

            if ($product && $product instanceof Product) {
              $model = new ProductOrder;
              try {
                $model->fill([
                    'order_id' => $this->id,
                    'product_id' => $products[$i]->product_id,
                    'count' => $products[$i]->count,
                    'product_name' => $product->name,
                    'product_cost' => $product->cost,
                    'product_articul' => $product->articul
                ]);
              } catch (\Exception $err) {
                logger($err->getMessage());
                throw $err;
              }
              try {
                $model->save();
              } catch (\Exception $err) {
                logger($err->getMessage());
                throw $err;
              }
              $this->$currentProducts[] = $model;
            }
        }
        return $this->$currentProducts;
    }
    /**
    *
    */
    public function setDeliveries(object $deliveryData) : OrderDelivery
    {
      try {
        $delivery = Delivery::findOrFail($deliveryData->id);
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }
      //????????
      //$orderDelivery = new OrderDelivery;
      $this->currentDelivery = new OrderDelivery;
      try {
        $this->currentDelivery->fill([
          'delivery_id' => $deliveryData->id,
          'user_name' => $deliveryData->user_name,
          'user_surname' => $deliveryData->user_surname,
          'user_email' => $deliveryData->user_email,
          'user_phone' => $deliveryData->user_phone,
          'user_adress' => $deliveryData->user_adress,
          'user_adress' => $deliveryData->user_adress,
          'delivery_name' => $delivery->name,
          'delivery_cost' => $delivery->delivery_cost
        ]);
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }
      try {
        $this->currentDelivery->save();
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }
      return $this->currentDelivery;
    }

    public function setPayments (object $paymentData) : OrderPayment
    {
      try {
        $payment = Payment::findOrFail($paymentData->id);
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }

      $this->currentPayment = new OrderPayment;

      try {
        $this->currentPayment->fill([
          // 'payment_id' => $paymentData->id,
          'payment_name' => $payment->name,
          'payment_cost' => $payment->cost
        ]);
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }
      try {
        $this->currentPayment->save();
      } catch (\Exception $err) {
        logger($err->getMessage());
        throw $err;
      }
      return $this->currentPayment;
    }

    public function setDefaultStatus () : OrderStatus
    {
      try {
        $setting = Setting::select('value')
              ->where('name', 'defaultOrderStatus')
              ->first();
      } catch (\Exception $err) {
        logger($err->getMessage());
				throw $err;
      }
      try {
        $status = OrderStatus::select('id')
              ->where('name', $setting->name)
              ->first();
      } catch (\Exception $err) {
        logger($err->getMessage());
				throw $err;
      }

      event(new CreateNewOrderEvent($status, $this));

      return ($this->order_status_id = $status->id);
    }

    /**
    *Установка номера для текущего заказа
    *@return {int}
    **/

    public function setNumber () : int
    {
      return ($this->number = $this->id + 14);
    }


    public function setCost () : float
    {
      $cost = 0;

      foreach ($this->currentProducts as $item) {
        $cost += $item->product_cost * $item->count;
      }
      $cost += $this->currentDelivery->delivery_cost;
      $cost += $this->currentPayment->payment_cost;

      return ($this->cost = $cost);
    }

}
