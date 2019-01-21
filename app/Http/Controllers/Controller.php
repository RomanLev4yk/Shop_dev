<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
    *GET model
    *@param {int} $id
    *@param {Request} $request
    *@return {JsonResponse}
    */
    public function item(int $id, Request $request) : JsonResponse
    {
      return response()->json([], 200);
    }
    /**
    *GET collection
    *@param {Request} $request
    *@return {JsonResponse}
    */
    public function collection(Request $request) : JsonResponse
    {
      return response()->json([], 200);
    }
    /**
    *CREATE model
    *@param {Request} $request
    *@return {JsonResponse}
    */
    public function create(Request $request) : JsonResponse
    {
      return response()->json([], 200);
    }
    /**
    *Update model
    *@param {int} $id
    *@param {Request} $request
    *@return {JsonResponse}
    */
    public function update(int $id, Request $request) : JsonResponse
    {
      return response()->json([], 200);
    }
    /**
    *Delete model
    *@param {int} $id
    *@param {Request} $request
    *@return {JsonResponse}
    */
    public function delete(int $id, Request $request) : JsonResponse
    {
      return response()->json([], 200);
    }
    /**
    * Add paggination
    *
    * @param QueryBuilder $q
    * @param array $param
    * @return QueryBuilder
    */
     public function setPaginationQuery($q, array $params)
     {
      if (isset($params['start']) && isset($params['limit'])) {
         try {
          $q = $q->forPage($params['start'], $params['limit']);
         }
         catch (\Exception $err) {
          logger($err->getMessage());

          throw $err;
         }
      } else {
         try {
           $q = $q->limit(10);
         } catch (\Exception $err) {
           logger($err->getMessage());

           throw new $err;
         }
      }
      return $q;
     }

     public function setParamsBeforeQuery($q, array $params)
     {
       if (isset($params['created_at'])) {
         $q = $q->where('created_at', $params['created_at']);
       }

       if (isset($params['updated_at'])) {
         $q = $q->where('updated_at', $params['updated_at']);
       }
       return $q;
     }

     public function validateEmail(string $email = '') : string
	   {
		     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			        throw new \Exception(__('responses.invalid_email'));
		     }
		  return $email;
	   }

  public function buildViewClassPath(string $viewName) : string
  {
    $explode = explode('.', $viewName);

    $viewName = '';
    foreach ($explode as $item) {
      $viewName .= ucfirst($item);
    }

    return 'App\\Http\\Views\\' . ucfirst($viewName) . 'View';
  }
}
