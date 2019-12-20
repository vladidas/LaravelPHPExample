<?php

namespace App\Data\Models;

use App\Data\Traits\SortableTrait;
use Illuminate\Notifications\Notifiable;
use App\Data\Interfaces\SortableInterface;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Collection;

/**
 * Class User
 * @package App\Data\Models
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class User extends Authenticatable implements SortableInterface
{
    use Notifiable, SortableTrait;

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
     * @param int|null $sortId
     * @param string|null $field
     * @param string|null $sort
     * @param string $defaultField
     * @param string $defaultSort
     */
    static function getHistorySort(
        ?int $sortId,
        ?string &$field,
        ?string &$sort,
        string $defaultField = 'paid_at',
        string $defaultSort  = 'desc'
    ) {
        if (array_key_exists($sortId, self::getSortsList())) {
            $field = self::getHistorySortsList()[$sortId]['field'];
            $sort  = self::getHistorySortsList()[$sortId]['sort'];
        } else {
            $field = $defaultField;
            $sort  = $defaultSort;
        }
    }

    /**
     * @return array
     */
    static function getHistorySortsList(): array
    {
        return [
            1 => ['title' => __('app.sortable.transaction_desc'), 'field' => 'transaction', 'sort' => 'desc'],
            2 => ['title' => __('app.sortable.transaction_asc'),  'field' => 'transaction', 'sort' => 'asc'],
            3 => ['title' => __('app.sortable.paid_at_desc'),     'field' => 'paid_at', 'sort' => 'desc'],
            4 => ['title' => __('app.sortable.paid_at_asc'),      'field' => 'paid_at', 'sort' => 'asc'],
        ];
    }

    /**
     * @param string|null $field
     * @return Collection
     */
    static function getHistorySortsTitle(?string $field = 'title'): Collection
    {
        return collect(self::getHistorySortsList())->mapWithKeys(function ($item, $key) use ($field) {
            return [$key => $item[$field]];
        });
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return float|null
     */
    public function getTransaction(): ?float
    {
        return $this->transaction;
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
     * @return float
     */
    public function getBonuses(): float
    {
        return $this->bonuses;
    }

    /**
     * @return string|null
     */
    public function getPhone(): ?string
    {
        return $this->phone;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getFullName(): string
    {
        return $this->full_name;
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
     * @return string|null
     */
    public function getPaidAt(): ?string
    {
        return $this->paid_at;
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->name . ' ' . $this->surname;
    }
}
