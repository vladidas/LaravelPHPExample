<?php

namespace App\Data\Interfaces;

/**
 * Interface SortableInterface
 * @package App\Data\Interfaces
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
interface SortableInterface
{
    /**
     * @return array
     */
    static function getSortsList(): array;

    /**
     * @param int $sortId
     * @param string $field
     * @param string $sort
     * @return mixed
     */
    static function getSort(int $sortId, string &$field, string &$sort);
}
