<?php

namespace App\Http\Controllers\api\V1;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthApiController extends Controller
{
    /**
     * POST /api/v1/auth/login
     * 
     * Connexion et génération de token
     */
    public function login(Request $request): JsonResponse
    {
        // Valider les données
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        // Chercher l'utilisateur par email
        $user = User::where('email', $validated['email'])->first();

        // Vérifier si l'utilisateur existe et le mot de passe est correct
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Identifiants incorrects',
            ], 401); // 401 = Unauthorized
        }

        // Créer un token
        $token = $user->createToken('api-token')->plainTextToken;

        return response()->json([
            'success' => true,
            'message' => 'Connexion réussie',
            'data' => [
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'role' => $user->role,
                ],
                'token' => $token,
            ],
        ], 200);
    }

    /**
     * POST /api/v1/auth/logout
     * 
     * Déconnexion et suppression du token
     */
    public function logout(Request $request): JsonResponse
    {
        // Supprimer le token actuel
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'success' => true,
            'message' => 'Déconnexion réussie',
        ], 200);
    }
        /**
     * GET /api/v1/auth/me
     * 
     * Récupérer les infos de l'utilisateur connecté
     */
    public function me(Request $request): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $request->user(),
        ], 200);
    }

    /**
     * POST /api/v1/auth/register
     * 
     * Inscription d'un nouveau patient
     */
    public function register(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);

        try {
            // Créer l'utilisateur
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'password' => Hash::make($validated['password']),
                'role' => 'patient', // Les nouveaux inscrits sont patients
            ]);

            // Créer un token
            $token = $user->createToken('api-token')->plainTextToken;

            return response()->json([
                'success' => true,
                'message' => 'Inscription réussie',
                'data' => [
                    'user' => $user,
                    'token' => $token,
                ],
            ],201);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'inscription',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
