<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Validation\ValidationErrors;

/**
 * ハーブの品種
 * Class Variety
 * @package Kit\Domain\Model\Kit\Row
 * @OA\Schema(
 *     title="Variety",
 *     description="ハーブの品種",
 * )
 */
final class Variety implements Arrayable
{
    /**
     * @OA\Property()
     * @var VarietyName
     */
    private VarietyName $varietyName;

    /**
     * @OA\Property()
     * @var VarietyNumber
     */
    private VarietyNumber $varietyNumber;

    /**
     * Variety constructor.
     * @param VarietyName $varietyName
     */
    private function __construct(VarietyName $varietyName)
    {
        $this->varietyName = $varietyName;
        $this->varietyNumber = VarietyNumber::numbering();
    }

    /**
     * @param VarietyName $varietyName
     * @return Variety
     */
    public static function fromVarietyName(VarietyName $varietyName): Variety
    {
        return new Variety($varietyName);
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->varietyName->errors();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'varietyName' => $this->varietyName->toArray(),
            'varietyNumber' => $this->varietyNumber->toArray(),
        ];
    }

    /**
     * @return VarietyNumber
     */
    public function number(): VarietyNumber
    {
        return $this->varietyNumber;
    }

    /**
     * @throws DomainValidationException
     */
    public function validate(): void
    {
        $errors = $this->errors();
        if ($errors->hasError()) {
            $errors->throwValidationException();
        }
    }
}
