<?php

namespace App\Http\Controllers;

use App\Modules\Subscription\Models\Subscriber;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriberController extends Controller
{
    /**
     * Suscribir usuario autenticado
     */
    public function subscribe(Request $request)
    {
        $request->validate([
            'frequency' => 'required|in:daily,weekly,monthly',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $user = Auth::user();

        // Verificar si ya está suscrito
        $existing = Subscriber::where('user_id', $user->id)->first();

        if ($existing && $existing->is_active) {
            return response()->json([
                'status' => 'already_subscribed',
                'message' => __('You are already subscribed')
            ], 200);
        }

        // Crear o reactivar suscripción
        Subscriber::updateOrCreate(
            ['user_id' => $user->id],
            [
                'frequency' => $request->frequency,
                'category_preferences' => $request->categories,
                'is_active' => true,
                'subscribed_at' => now(),
                'unsubscribed_at' => null,
            ]
        );

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully subscribed to newsletter')
        ], 200);
    }

    /**
     * Cancelar suscripción
     */
    public function unsubscribe(Request $request)
    {
        $subscriber = Subscriber::where('user_id', Auth::id())->first();

        if (!$subscriber) {
            return response()->json([
                'status' => 'error',
                'message' => __('Subscription not found')
            ], 404);
        }

        $subscriber->deactivate();

        return response()->json([
            'status' => 'success',
            'message' => __('Successfully unsubscribed')
        ], 200);
    }

    /**
     * Actualizar preferencias de suscripción
     */
    public function updatePreferences(Request $request)
    {
        $request->validate([
            'frequency' => 'required|in:daily,weekly,monthly',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:categories,id',
        ]);

        $subscriber = Subscriber::where('user_id', Auth::id())->first();

        if (!$subscriber) {
            return response()->json([
                'status' => 'error',
                'message' => __('Subscription not found')
            ], 404);
        }

        $subscriber->update([
            'frequency' => $request->frequency,
            'category_preferences' => $request->categories,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => __('Preferences updated successfully')
        ], 200);
    }
}