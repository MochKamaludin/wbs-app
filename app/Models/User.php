<?php

namespace App\Models;

use Filament\Models\Contracts\FilamentUser;
use Filament\Models\Contracts\HasName;
use Filament\Panel;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements FilamentUser, HasName
{
    use Notifiable;

    protected $table = 'trwblsadm';
    protected $primaryKey = 'i_wbls_adm';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = false;

    protected $fillable = [
        'i_wbls_adm',
        'c_wbls_admpswd',
        'n_wbls_adm',
        'i_emp',
        'c_wbls_admauth',
        'i_entry',
        'd_entry',
    ];

    protected $hidden = ['c_wbls_admpswd'];

    public function getAuthPassword(): string
    {
        return (string) $this->c_wbls_admpswd;
    }

    public function getAuthIdentifierName(): string
    {
        return 'i_wbls_adm';
    }

    /* ================= FILAMENT v4 ================= */

    public function canAccessPanel(Panel $panel): bool
    {
        return true; 
    }

    public function getFilamentName(): string
    {
        return (string) ($this->n_wbls_adm ?: $this->i_wbls_adm);
    }

    public function isAdmin()
    {
        return $this->c_wbls_admauth === "0";
    }

    public function isVerifikator()
    {
        return $this->c_wbls_admauth === "1";
    }

    public function isInvestigator()
    {
        return $this->c_wbls_admauth === "2";
    }
}
