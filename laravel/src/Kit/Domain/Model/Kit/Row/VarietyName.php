<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Validation\UsingValidator;
use Kit\Domain\Validation\ValidationErrors;

/**
 * Class VarietyName
 * @OA\Schema(
 *     description="品種名"
 * )
 */
final class VarietyName implements Arrayable
{
    use UsingValidator;

    /**
     * @OA\Property(
     *     format="string",
     * )
     * @var string|null
     */
    private ?string $value;

    /**
     * VarietyName constructor.
     * @param string|null $value
     */
    public function __construct(?string $value)
    {
        $this->value = $value;
        $this->validator(
            ['varietyName' => ['value' => $value]],
            ['varietyName.value' => $this->rules()]
        );
    }

    /**
     * @return array<int, string>
     */
    private function rules(): array
    {
        return ['required', 'string', 'between:3,20'];
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->validator->errors();
    }

    /**
     * @return array<string, string|null>
     */
    public function toArray(): array
    {
        return ['value' => $this->value];
    }
}
