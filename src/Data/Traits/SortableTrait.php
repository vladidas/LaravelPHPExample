<?php

namespace App\Data\Traits;

use Illuminate\Support\Collection;

/**
 * Trait SortableTrait
 * @package App\Data\Traits
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
trait SortableTrait
{
    /**
     * @param int|null $sortId
     * @param string|null $field
     * @param string|null $sort
     * @param string $defaultField
     * @param string $defaultSort
     */
    static function getSort(
        ?int $sortId,
        ?string &$field,
        ?string &$sort,
        string $defaultField = 'created_at',
        string $defaultSort  = 'desc'
    ) {
        if (array_key_exists($sortId, self::getSortsList())) {
            $field = self::getSortsList()[$sortId]['field'];
            $sort  = self::getSortsList()[$sortId]['sort'];
        } else {
            $field = $defaultField;
            $sort  = $defaultSort;
        }
    }

    /**
     * @param string|null $field
     * @return Collection
     */
    static function getSortsTitle(?string $field = 'title'): Collection
    {
        return collect(self::getSortsList())->mapWithKeys(function ($item, $key) use ($field) {
            return [$key => $item[$field]];
        });
    }
}
