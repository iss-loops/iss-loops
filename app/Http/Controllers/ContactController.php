<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modules\Contact\Models\ContactMessage;
use Illuminate\Support\Facades\Validator;

class ContactController extends Controller
{
    /**
     * Mostrar formulario de contacto
     */
    public function show($locale)
    {
        return view('pages.institutional.contact');
    }

    /**
     * Procesar envío de formulario
     */
    public function send(Request $request)
    {
        // Validación
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:20|max:5000',
        ], [
            'name.required' => __('Name is required'),
            'email.required' => __('Email is required'),
            'email.email' => __('Please enter a valid email'),
            'subject.required' => __('Subject is required'),
            'message.required' => __('Message is required'),
            'message.min' => __('Message must be at least 20 characters'),
            'message.max' => __('Message must not exceed 5000 characters'),
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        try {
            // Guardar mensaje en base de datos
            $contactMessage = ContactMessage::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'locale' => app()->getLocale(),
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
            ]);

            // TODO: Aquí se enviará el email en producción
            // Mail::to(config('mail.from.address'))->send(new ContactFormMail($contactMessage));

            return response()->json([
                'status' => 'success',
                'message' => __('Thank you for contacting us! We will respond as soon as possible.')
            ], 200);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => __('An error occurred while sending your message. Please try again.')
            ], 500);
        }
    }
}