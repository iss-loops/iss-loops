<?php

namespace App\Modules\Contact\Models;

use Illuminate\Database\Eloquent\Model;

class ContactMessage extends Model
{
    protected $fillable = [
        'name',
        'email',
        'subject',
        'message',
        'locale',
        'ip_address',
        'user_agent',
        'is_read',
        'read_at'
    ];

    protected $casts = [
        'is_read' => 'boolean',
        'read_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Scope para mensajes no leídos
     */
    public function scopeUnread($query)
    {
        return $query->where('is_read', false);
    }

    /**
     * Scope para mensajes leídos
     */
    public function scopeRead($query)
    {
        return $query->where('is_read', true);
    }

    /**
     * Marcar como leído
     */
    public function markAsRead()
    {
        $this->update([
            'is_read' => true,
            'read_at' => now()
        ]);
    }

    /**
     * Marcar como no leído
     */
    public function markAsUnread()
    {
        $this->update([
            'is_read' => false,
            'read_at' => null
        ]);
    }
}