<?php

declare(strict_types=1);

namespace Kit\Presentation\Api\Kit;

use Kit\Domain\Model\Kit\Feature\Features;
use Kit\Domain\Model\Kit\Row\Rows;
use Kit\Domain\Model\Kit\Specification\DateOfSeed;
use Kit\Domain\Model\Kit\Specification\Specification;
use Kit\Domain\Type\Covered;
use Kit\Domain\Type\Type;
use Kit\Presentation\Api\Request;

final class StarterKitRegisterRequest extends Request
{

    /**
     * @return Specification
     */
    public function createSpecification(): Specification
    {
        return new Specification(
            new DateOfSeed($this->dateOfSeed['value']),
            new Covered($this->covered),
            new Type($this->type),
            Features::fromArray($this->features['list']),
            Rows::fromArray($this->rows['list'])
        );
    }

    public function rules(): array
    {
        return [];
    }
}
