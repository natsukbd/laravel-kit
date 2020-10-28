<?php

declare(strict_types=1);

namespace Kit\Presentation\Api\Kit;

use Kit\Domain\Model\Kit\Row\VarietyName;
use Kit\Presentation\Api\Request;

final class VarietyRegisterRequest extends Request
{
    /**
     * @return VarietyName
     */
    public function createVarietyName(): VarietyName
    {
        return new VarietyName($this->value);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [];
    }
}
