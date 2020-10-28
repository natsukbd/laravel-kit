<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Specification;

use Exception;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Carbon;

/**
 * Class DateOfSeed
 * @package Kit\Domain\Model\Kit\Specification
 * @OA\Schema(
 *     description="種をまいた日",
 * )
 */
final class DateOfSeed implements Arrayable
{
    /**
     * @OA\Property(
     *     type="string"
     * )
     * @var Carbon
     */
    private Carbon $value;

    /**
     * DateOfSeed constructor.
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->value = new Carbon($value);
    }

    /**
     * @return array<int, string>
     */
    public static function valueRules(): array
    {
        return ['required', 'date:Y/m/d'];
    }

    /**
     * @return DateOfSeed
     * @throws Exception
     */
    public static function today(): DateOfSeed
    {
        return new static(Carbon::today()->toString());
    }

    /**
     * @return string
     */
    public function when(): string
    {
        return $this->value->format('m月d日');
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->value->toString();
    }

    /**
     * @return array<string, string>
     */
    public function toArray(): array
    {
        return ['value' => $this->when()];
    }
}
