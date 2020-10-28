<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Validation\UsingValidator;
use Kit\Domain\Validation\ValidationErrors;

/**
 * 列
 * Class Row
 * @package Kit\Domain\Model\Kit\Row
 * @OA\Schema(
 *     description="列"
 * )
 */
final class Row implements Arrayable
{
    use UsingValidator;

    /**
     * @OA\Property()
     */
    private Variety $variety;

    /**
     * @OA\Property(
     *     description="セルあたりの種の数",
     *     format="integer",
     * )
     */
    private int $seedsPerCell;

    /**
     * Row constructor.
     * @param Variety $variety
     * @param int $seedsPerCell
     */
    public function __construct(Variety $variety, int $seedsPerCell)
    {
        $this->variety = $variety;
        $this->seedsPerCell = $seedsPerCell;
        $this->validator(
            ['seedsPerCell' => $seedsPerCell],
            ['seedsPerCell' => $this->rules()]
        );
    }

    /**
     * @return array<int, string>
     */
    public function rules(): array
    {
        return ['required', 'integer', 'between:1, 20'];
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->validator->merge($this->variety->errors());
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'variety' => $this->variety->toArray(),
            'seedsPerCell' => $this->seedsPerCell,
        ];
    }
}
