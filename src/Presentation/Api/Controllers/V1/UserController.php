<?php

namespace Presentation\Api\Controllers\V1;

use App\Http\Controllers\Controller;
use Application\Requests\UserRequest;
use Application\Service\V1\Contracts\UserServiceIterface;
use Application\Dtos\UserDto;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public UserServiceIterface $userServiceIterface;

    public function __construct(
        UserServiceIterface $userServiceIterface
    )
    {
        $this->userServiceIterface = $userServiceIterface;
    }

    public function store(UserRequest $request)
    {
        return response()->json(
            $this->userServiceIterface->store(new UserDto(
                $request->name,
                $request->email,
                $request->password,
                $request->is_active
            ))
        );
    }

    public function show(int $id)
    {
        return response()->json(
            $this->userServiceIterface->show($id)
        );
    }
}
