<?php

namespace App\Http\Controllers;

use App\Enum\ResponseCode;
use App\Helpers\Response;
use App\Services\User\IUserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    protected $iUserService;
    public function __construct(IUserService $iUserService)
    {
        $this->iUserService = $iUserService;
    }
    public function getUsers()
    {
        try {
            $users = $this->iUserService->getUsers();
            if ($users) {
                return Response::success($users, 'Get Users Successfully');
            } else {
                return Response::error(ResponseCode::NOT_FOUND, 'No Users Found');
            }
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
    public function getUserById(string $user_id)
    {
        try {
            $user = $this->iUserService->getUserById($user_id);
            if ($user) {
                return Response::success($user, 'Get User Successfully');
            } else {
                return Response::error(ResponseCode::NOT_FOUND, 'User Not Found');
            }
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
}
