<?php

declare(strict_types=1);

namespace Kit\Infrastructure\Validation;

use Illuminate\Contracts\Validation\Factory;
use Kit\Domain\Validation\ValidationErrors;
use Validation\Validator;

/**
 * Class DataValidator
 * @package Kit\Infrastructure\Validation
 */
final class DataValidator implements Validator
{
    /**
     * @var \Illuminate\Contracts\Validation\Validator
     */
    private \Illuminate\Contracts\Validation\Validator $validator;

    /**
     * Validator constructor.
     * @param Factory $validationFactory
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     */
    private function __construct(
        Factory $validationFactory,
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ) {
        $this->validator = $validationFactory->make($data, $rules, $messages, $customAttributes);
    }

    /**
     * @param Factory $validationFactory
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return Validator
     */
    public static function create(
        Factory $validationFactory,
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ): Validator {
        return new static($validationFactory, $data, $rules, $messages, $customAttributes);
    }

    /**
     * @return bool
     */
    public function fails(): bool
    {
        return $this->validator->fails();
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return ValidationErrors::fromMessageBag($this->validator->errors());
    }

    /**
     * @param ValidationErrors $errors
     * @return ValidationErrors
     */
    public function merge(ValidationErrors $errors): ValidationErrors
    {
        return ValidationErrors::fromMessageBag($this->validator->errors())->merge($errors);
    }
}
