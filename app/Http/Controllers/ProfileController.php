<?php

namespace App\Http\Controllers;

use App\Enum\ResponseCode;
use App\Helpers\Response;
use App\Http\Requests\UpdateProfileRequest;
use App\Services\Profile\IProfileService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProfileController extends Controller
{
    protected $iProfileService;
    public function __construct(IProfileService $iProfileService)
    {
        $this->iProfileService = $iProfileService;
    }
    public function getProfile(Request $request)
    {
        try {
            $user_id = $request->input('user_id');
            $personal_info = $this->iProfileService->getProfile($user_id);
            return Response::success($personal_info, 'Profile fetched successfully');
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        try {
            $data = $request->validated();
            return Response::success($data, 'Profile updated successfully');
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }

}
