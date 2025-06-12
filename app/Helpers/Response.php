<?php
namespace App\Helpers;
class Response
{
  public static function success($data = null, $message = 'Success', $statusCode = 200)
  {
    return response()->json([
      'message' => $message,
      'data' => $data
    ], $statusCode);
  }
  public static function error($message = 'Error', $statusCode = 500, $data = null)
  {
    return response()->json([
      'message' => $message,
      'data' => $data
    ], $statusCode);
  }
}