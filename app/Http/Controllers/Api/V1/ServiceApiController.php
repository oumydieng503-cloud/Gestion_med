<?php
namespace App\Http\Controllers\Api\V1;
use App\Http\Controllers\Controller;
use App\Models\Service;
class ServiceApiController extends Controller
{
    public function index( Request $request):JsonResponse
    {
        try{
            $Services = Service::where('statut', 'actif')->whise('medecin')->paginate(10);
            return reponse()->json([
                'success' => true,
                'message' => 'Services recuperer avec succes',
                'data' => $Services
            ], 200 
            );
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la recuperation des services',
                'error' => $e->getMessage()
            ], 500);

        }
        
    }
    /**
     * POST /api/v1/services
     * 
     * Créer un nouveau service (admin uniquement)
     */
    public function store(Request $request): JsonResponse
    {
        // Valider les données
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'duree' => 'required|integer|min:15',
            'medecin_id' => 'nullable|exists:users,id',
            'statut' => 'required|in:actif,inactif',
        ]);

        try {
            $service = Service::create($validated);

            return response()->json([
                'success' => true,
                'message' => 'Service créé avec succès',
                'data' => $service,
            ], 201); // 201 = Created

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la création',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * GET /api/v1/services/{service}
     * 
     * Afficher un service spécifique
     */
    public function show(Service $service): JsonResponse
    {
        try {
            $service->load('medecin', 'reservations');

            return response()->json([
                'success' => true,
                'message' => 'Service trouvé',
                'data' => $service,
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Service non trouvé',
                'error' => $e->getMessage(),
            ],  404);
        }
    }
        /**
     * PUT /api/v1/services/{service}
     * 
     * Mettre à jour un service (admin uniquement)
     */
    public function update(Request $request, Service $service): JsonResponse
    {
        $validated = $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'prix' => 'required|numeric|min:0',
            'duree' => 'required|integer|min:15',
            'medecin_id' => 'nullable|exists:users,id',
            'statut' => 'required|in:actif,inactif',
        ]);

        try {
            $service->update($validated);

            return response()->json([
                'success' => true,
                'message' => 'Service mis à jour avec succès',
                'data' => $service,
            ], 200);

            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * DELETE /api/v1/services/{service}
     * 
     * Supprimer un service (admin uniquement)
     */
    public function destroy(Service $service): JsonResponse
    {
        try {
            $service->delete();

            return response()->json([
                'success' => true,
                'message' => 'Service supprimé avec succès',
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


   
}