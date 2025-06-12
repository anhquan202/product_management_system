<?php
namespace App\Enum;
class ResponseStatus
{
  public const SUCCESS = 'success';
  public const ERROR = 'error';
  public const UNAUTHORIZED = 'unauthorized';
  public const FORBIDDEN = 'forbidden';
  public const NOT_FOUND = 'not_found';
  public const VALIDATION_ERROR = 'validation_error';
}