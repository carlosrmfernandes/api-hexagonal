<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Presentation\Api\Controllers\V1;

use Application\Service\V1\Contracts\UserServiceIterface;
use Illuminate\Http\JsonResponse;
use function auth;
use function request;
use function response;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    public UserServiceIterface $userServiceIterface;
    public function __construct(
        UserServiceIterface $userServiceIterface
    )
    {
        $this->userServiceIterface = $userServiceIterface;
        $this->middleware('apiJwt', ['except' => ['login']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return JsonResponse
     */
    public function login(): JsonResponse
    {
        $credentials = request(['email', 'password']);
        if ($this->userServiceIterface->login($credentials)) {
            if (!$token = auth('api')->attempt($credentials)) {
                return response()->json(['error' => 'Usuário não autorizado'], 401);
            }
            if (!$this->userServiceIterface->login($credentials)->is_active) {
                return response()->json(['error' => 'Usuário inativo'], 401);
            }
            return $this->respondWithToken($token);
        } else {
            return response()->json(['error' => 'Usuário não foi encontrado']);
        }
    }

    /**
     * Get the authenticated UserS.
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json(auth('api')->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->logout();

        return response()->json(['data' => 'Sucesso']);
    }

    /**
     * Refresh a token.
     *
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        return $this->respondWithToken(auth('api')->refresh());
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return JsonResponse
     */
    protected function respondWithToken(string $token)
    {
        $user = auth('api')->user();
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => $user
        ]);
    }

}
