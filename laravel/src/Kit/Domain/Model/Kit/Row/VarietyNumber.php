<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Validation\UsingValidator;
use Kit\Domain\Validation\ValidationErrors;
use Kit\Domain\Type\Identity;

/**
 * Class VarietyNumber
 * @package Kit\Domain\Model\Kit\Row
 * @OA\Schema(
 *     description="ハーブの品種番号",
 * )
 */
final class VarietyNumber implements Arrayable
{
    /**
     * @OA\Property(
     *     format="string",
     * )
     * @var string
     */
    private string $value;

    /**
     * VarietyNumber constructor.
     * @param string $value
     */
    private function __construct(string $value)
    {
        $this->value = $value;
    }

    private const FORMAT = 'SP-%s';

    /**
     * @return VarietyNumber
     */
    public static function numbering(): VarietyNumber
    {
        $result = (new Identity(self::FORMAT))->generate();
        return new VarietyNumber($result);
    }

    /**
     * @return string[]
     */
    public function toArray(): array
    {
        return ['value' => $this->value];
    }
}
