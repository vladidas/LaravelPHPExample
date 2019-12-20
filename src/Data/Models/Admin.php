<?php

namespace App\Data\Models;

use App\Data\Traits\SortableTrait;
use Illuminate\Notifications\Notifiable;
use App\Data\Interfaces\SortableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class Admin
 * @package App\Data\Models
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class Admin extends Authenticatable implements SortableInterface
{
    use Notifiable, SortableTrait;

    /**
     * Declare roles.
     */
    const ROLE_SUPER_ADMIN = 1;
    const ROLE_ADMIN       = 2;
    const ROLE_SELLER      = 3;

    /**
     * Declare the roles alias for naming permissions.
     */
    const ROLES_ALIAS = [
        'admin'       => self::ROLE_ADMIN,
        'super_admin' => self::ROLE_SUPER_ADMIN,
        'seller'      => self::ROLE_SELLER,
    ];

    /**
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * @return array
     */
    static function getSortsList(): array
    {
        return [
            1 => ['title' => __('app.sortable.id_desc'),   'field' => 'id',   'sort' => 'desc'],
            2 => ['title' => __('app.sortable.id_asc'),    'field' => 'id',   'sort' => 'asc'],
            3 => ['title' => __('app.sortable.name_desc'), 'field' => 'name', 'sort' => 'desc'],
            4 => ['title' => __('app.sortable.name_asc'),  'field' => 'name', 'sort' => 'asc'],
        ];
    }

    /**
     * @return array
     */
    static function getRoles(): array
    {
        return [
            self::ROLE_SUPER_ADMIN => __('app.roles.super_admin'),
            self::ROLE_ADMIN       => __('app.roles.admin'),
            self::ROLE_SELLER      => __('app.roles.seller'),
        ];
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param array $roles
     * @return bool
     */
    public function havePermissions(array $roles = []): bool
    {
        foreach ($roles as $role) {
            if (
                array_key_exists($role, Admin::ROLES_ALIAS) &&
                Admin::ROLES_ALIAS[$role] === $this->getRoleId()
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

    /**
     * @return string
     */
    public function getRoleName(): string
    {
        return $this->getRoles()[$this->role_id];
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return int
     */
    public function getRoleId(): int
    {
        return $this->role_id;
    }

    /**
     * @return bool
     */
    public function isSuperAdmin(): bool
    {
        return $this->role_id === self::ROLE_SUPER_ADMIN;
    }

    /**
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role_id === self::ROLE_ADMIN;
    }

    /**
     * @return bool
     */
    public function isSeller(): bool
    {
        return $this->role_id === self::ROLE_SELLER;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
    }

    /**
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->remember_token;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }

    /**
     * @return bool
     */
    public function canEditAdmin(): bool
    {
        return (bool)$this->can_edit_admin;
    }

    /**
     * @return bool
     */
    public function canDeleteAdmin(): bool
    {
        return (bool)$this->can_delete_admin;
    }

    /**
     * @return bool
     */
    public function sendLetters(): bool
    {
        return (bool)$this->send_letters;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->created_at;
    }

    /**
     * @return string
     */
    public function getUpdatedAt(): string
    {
        return $this->updated_at;
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function outlets()
    {
        return $this->belongsToMany(Outlet::class, 'outlets_admins')->withPivot('role_id');
    }
}
