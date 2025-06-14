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
    public function getProfile()
    {
        try {
            $personal_info = $this->iProfileService->getProfile();
            return Response::success($personal_info, 'Profile fetched successfully');
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }
    public function updateProfile(UpdateProfileRequest $request)
    {
        $credentials = $request->validated();
        try {
            $new_personal_profile = $this->iProfileService->updateProfile($credentials);
            return Response::success($new_personal_profile, 'Profile updated successfully');
        } catch (\Throwable $th) {
            return Response::error(ResponseCode::INTERNAL_SERVER_ERROR, $th->getMessage());
        }
    }

}
