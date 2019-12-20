<?php

namespace App\Services\Frontend\Rules;

use App\Data\Models\User;
use App\Data\Models\Product;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Foundation\Bus\DispatchesJobs;
use App\Domains\Auth\User\Jobs\GetSumBonusesByUserJob;

/**
 * Class EnoughBonusesRule
 * @package App\Services\Frontend\Rules
 * @author  Vlad Golubtsov <v.golubtsov@bvblogic.com>
 */
class EnoughBonusesRule implements Rule
{
    use DispatchesJobs;

    /**
     * @var float
     */
    private $activeProductPrice;

    /**
     * @var User
     */
    private $user;

    /**
     * EnoughBonusesRule constructor.
     * @param float $activeProductPrice
     */
    public function __construct(float $activeProductPrice = 0)
    {
        $this->user = auth()->guard('user')->user();
        $this->activeProductPrice = $activeProductPrice;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $bonuses = $this->dispatch(new GetSumBonusesByUserJob());

        return $this->user->getBonuses() >= $bonuses + $this->activeProductPrice;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.not_enough_balance');
    }
}
