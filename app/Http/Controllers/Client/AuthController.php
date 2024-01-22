<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\Client\Auth\LoginRequest;
use App\Http\Requests\Client\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['register', 'login']]);
    }

    /**
     * Регистрация пользователя.
     *
     * @OA\Post(
     *      path="/api/auth/register",
     *      operationId="register",
     *      tags={"Аутентификация"},
     *      @OA\RequestBody(
     *        required=true,
     *        description="Pass user data",
     *        @OA\JsonContent(
     *          required={"name","phone","password","password_confirmation"},
     *          @OA\Property(property="name", type="string", format="text", example="Иванов Иван"),
     *          @OA\Property(property="phone", type="string", format="email", example="79000000000"),
     *          @OA\Property(property="password", type="string", format="password", example="12345678"),
     *          @OA\Property(property="password_confirmation", type="string", format="password", example="12345678")
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request): JsonResponse
    {
        User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'password' => Hash::make($request->password)
        ]);

        $token = auth()->attempt($request->only(['phone', 'password']));

        return response()->json(array_merge(
            ['status' => true, 'message' => 'Учетная запись успешно создана.'],
            $this->respondWithToken($token)
        ));
    }

    /**
     * Авторизация пользователя.
     *
     * @OA\POST(
     *      path="/api/auth/login",
     *      operationId="login",
     *      tags={"Аутентификация"},
     *      @OA\RequestBody(
     *        required=true,
     *        description="Pass user data",
     *        @OA\JsonContent(
     *          required={"phone","password"},
     *          @OA\Property(property="phone", type="string", format="phone", example="79000000000"),
     *          @OA\Property(property="password", type="string", format="phone", example="12345678")
     *        )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent()
     *      )
     * )
     *
     * @param LoginRequest $request
     *
     * @return JsonResponse
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $credentials = request(['phone', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(array_merge(
            ['success' => true],
            $this->respondWithToken($token)
        ));
    }

    /**
     * Профиль.
     *
     * @OA\POST(
     *      path="/api/auth/me",
     *      operationId="me",
     *      tags={"Аутентификация"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent()
     *      ),
     *      security={{ "apiAuth": {} }}
     * )
     *
     * @return JsonResponse
     */
    public function me()
    {
        return response()->json([
            'success' => true,
            'user' => auth()->user()
        ]);
    }

    /**
     * Выход пользователя из системы.
     *
     * @OA\POST(
     *      path="/api/auth/logout",
     *      operationId="logout",
     *      tags={"Аутентификация"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent()
     *      ),
     *      security={{ "apiAuth": {} }}
     * )
     *
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json([
            'success' => true,
            'message' => 'Вы успешно вышли из системы.'
        ]);
    }

    /**
     * Обновление токена.
     *
     * @OA\POST(
     *      path="/api/auth/refresh",
     *      operationId="refresh",
     *      tags={"Аутентификация"},
     *      @OA\Response(
     *          response=200,
     *          description="OK",
     *          @OA\JsonContent()
     *      ),
     *      security={{ "apiAuth": {} }}
     * )
     *
     * @return JsonResponse
     */
    public function refresh()
    {
        return response()->json(array_merge(
            ['success' => true],
            $this->respondWithToken(auth()->refresh())
        ));
    }

    /**
     * Get the token array structure.
     *
     * @param string $token
     *
     * @return array
     */
    protected function respondWithToken(string $token)
    {
        return [
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ];
    }
}
