<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit;

use Illuminate\Contracts\Support\Arrayable;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Model\Kit\Specification\Specification;

/**
 * Class StarterKit
 * @package Kit\Domain\Model\Kit
 * @OA\Schema(
 *     description="ハーブ栽培キット",
 * )
 */
final class StarterKit implements Arrayable
{
    /**
     * @OA\Property()
     * @var KitNumber
     */
    private KitNumber $kitNumber;
    /**
     * @OA\Property()
     * @var Specification
     */
    private Specification $specification;

    /**
     * StarterKit constructor.
     * @param KitNumber $kitNumber
     * @param Specification $specification
     */
    private function __construct(KitNumber $kitNumber, Specification $specification)
    {
        $this->kitNumber = $kitNumber;
        $this->specification = $specification;
    }

    /**
     * @param Specification $specification
     * @return StarterKit
     */
    public static function fromSpecification(Specification $specification): StarterKit
    {
        return new static(KitNumber::numbering(), $specification);
    }

    /**
     * @return KitNumber
     */
    public function kitNumber(): KitNumber
    {
        return $this->kitNumber;
    }

    /**
     * @throws DomainValidationException
     */
    public function validate(): void
    {
        $errors = $this->specification->errors();
        if ($errors->hasError()) {
            $errors->throwValidationException();
        }
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'kitNumber' => $this->kitNumber->toArray(),
            'specification' => $this->specification->toArray()
        ];
    }
}
