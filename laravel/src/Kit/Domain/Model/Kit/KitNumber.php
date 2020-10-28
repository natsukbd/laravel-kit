<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit;

use Illuminate\Contracts\Support\Arrayable;
use Kit\Domain\Type\Identity;

/**
 * Class KitNumber
 * @OA\Schema(
 *     description="栽培キット番号"
 * )
 */
final class KitNumber implements Arrayable
{
    /**
     * @OA\Property(
     *     format="string",
     * )
     * @var string
     */
    private string $value;

    /**
     * KitNumber constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    private const FORMAT = 'KN-%s-%s';

    /**
     * @return KitNumber
     */
    public static function numbering(): KitNumber
    {
        $result = (new Identity(self::FORMAT))->generate();
        return new KitNumber($result);
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return ['value' => $this->value];
    }
}
