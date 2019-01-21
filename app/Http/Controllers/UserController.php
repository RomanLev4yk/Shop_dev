<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Model\User;

class UserController extends Controller
{
  public $successStatus = 200;

  public function item(int $id, Request $request) : JsonResponse
  {
    try {
      $model = User::findOrFail($id);
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
    $model = new User;
    try {
      $model = $model->fill([
        'name'=>$request->input('name'),
        'email'=>$request->input('email'),
        'password'=>$request->input('password'),
        'phone_user'=>$request->input('phone_user')
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
      $all = User::select('id', 'name', 'email', 'password', 'phone_user');
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
      'name' => 'string|unique:users|max:255|required',
      'email' => 'string|unique:users|max:255|required',
      'password' => 'required',
      'phone_user' => 'numeric'
    ]);

    try {
      $model = User::findOrFail($id);
    } catch (\Exception $err) {
      logger($err->getMessage());

      return response()->json([
        'status'=> false,
        'message' => $err->getMessage(),
        'model'=>null], 422);
    }

    try {
      $model = $model->fill($request->only('name', 'email', 'password', 'phone_user'));
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
      User::destroy($id);
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
          ->orwhere('email', 'like', '%' . $params['query'] . '%')
          ->orwhere('password', 'like', '%' . $params['query'] . '%')
          ->orwhere('phone_user', 'like', '%' . $params['query'] . '%');
    }
    return parent::setParamsBeforeQuery($q, $params);
  }

  /**
   * login api
   *
   * @return \Illuminate\Http\Response
   */
  public function login()
  {
      if (Auth::attempt(['email' => request('email'),'password' => request('password')])) {
          $user = Auth::user();
          $success['token'] =  $user->createToken('MyApp')->accessToken;
          return response()->json(['success' => $success], $this->successStatus);
      }
      else{
          return response()->json(['error'=>'Unauthorised'], 401);
      }
  }


  public function register(Request $request)
  {
      $validator = Validator::make($request->all(), [
          'name' => 'required',
          'email' => 'required|email',
          'password' => 'required',
          'c_password' => 'required|same:password',
      ]);
      if ($validator->fails()) {

          return response()->json(['error'=>$validator->errors()], 401);
      }
      $input = $request->all();
      $input['password'] = bcrypt($input['password']);
      $user = User::create($input);
      $success['token'] =  $user->createToken('MyApp')->accessToken;
      $success['name'] =  $user->name;

      return response()->json(['success'=>$success], $this->successStatus);
  }
}
