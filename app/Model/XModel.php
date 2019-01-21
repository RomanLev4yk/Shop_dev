<?php
namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class XModel extends Model
{
    protected $guarded = [];

    public function setSimpleDefaultModels(String $name, String $columm, array $params = []) : array
    {
        foreach ($params as $item) {
            $model = new $name;
            try {
                $model->fill([
                    $columm => $item,
                    'product_id' => $this->id
                ]);
            } catch (\Exception $err) {
                logger($err->getMessage());
                throw $err;
            }
            try {
                $model->save();
            } catch (\Exception $err) {
                logger($err->getMessage());
            }
        }
        return $params;
    }
}
