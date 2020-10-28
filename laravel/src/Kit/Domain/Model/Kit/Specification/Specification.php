<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Specification;

use Illuminate\Contracts\Support\Arrayable;
use Kit\Domain\Model\Kit\Feature\Features;
use Kit\Domain\Model\Kit\Row\Rows;
use Kit\Domain\Validation\ValidationErrors;
use Kit\Domain\Type\Covered;
use Kit\Domain\Type\Type;

/**
 * Class Specification
 * @OA\Schema(
 *     title="Specification",
 *     description="キットの仕様",
 *     @OA\Xml(
 *         name="Specification"
 *     )
 * )
 * @package Kit\Domain\Model\Kit\Specification
 */
final class Specification implements Arrayable
{
    /**
     * @OA\Property()
     * @var Covered
     */
    private Covered $covered;

    /**
     * @OA\Property()
     * @var DateOfSeed
     */
    private DateOfSeed $dateOfSeed;

    /**
     * @OA\Property()
     * @var Features
     */
    private Features $features;

    /**
     * @OA\Property()
     * @var Rows
     */
    private Rows $rows;

    /**
     * @OA\Property()
     * @var Type
     */
    private Type $type;

    /**
     * Specification constructor.
     * @param DateOfSeed $dateOfSeed
     * @param Covered $covered
     * @param Type $type
     * @param Features $features
     * @param Rows $rows
     */
    public function __construct(DateOfSeed $dateOfSeed, Covered $covered, Type $type, Features $features, Rows $rows)
    {
        $this->dateOfSeed = $dateOfSeed;
        $this->covered = $covered;
        $this->type = $type;
        $this->features = $features;
        $this->rows = $rows;
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->rows->errors();
    }

    /**
     * @return array<string, array|Covered|Type>
     */
    public function toArray(): array
    {
        return [
            'covered' => $this->covered,
            'dateOfSeed' => $this->dateOfSeed->toArray(),
            'features' => $this->features->toArray(),
            'rows' => $this->rows->toArray(),
            'type' => $this->type
        ];
    }
}
