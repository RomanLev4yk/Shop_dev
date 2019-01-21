<?php
namespace App\Model;

class Product extends XModel
{

	public function setProperties(array $properties = []) : array
	{
		$i = 0;
		$output = [];
		while($i < count($properties)) {
			$model = new ProductProperty;
			try {
				$model->fill([
					'product_id' => $this->id,
					'property_id' => $properties[$i]->property_id,
					'value' => $properties[$i]->value
				]);
			}
			catch(\Exception $err) {
				logger($err->getMessage());
				throw $err;
			}
			try {
				$model->save();
			}
			catch(\Exception $err) {
				logger($err->getMessage());
				throw $err;
			}
			$output[] = $model;
			$i++;
		}
		return $output;
	}


	public function images ()
	{
		return $this->hasMany(ProductImage::class);
	}
	public function videos ()
	{
		return $this->hasMany(ProductVideo::class);
	}
	public function categories ()
	{
		return $this->hasOne(ProductCategory::class, 'product_id');
	}
	public function collections ()
	{
		return $this->hasOne(ProductCollection::class, 'product_id');
	}
	public function properties ()
	{
		return $this->hasOne(ProductProperty::class, 'product_id');
	}
	public function vendor ()
	{
		return $this->hasOne(Vendor::class, 'id');
	}
	public function orders ()
	{
		return $this->hasOne(ProductOrder::class, 'product_id');
	}
}
