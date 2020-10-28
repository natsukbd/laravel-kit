<?php

declare(strict_types=1);

namespace Validation;

use Kit\Domain\Validation\ValidationErrors;
use Illuminate\Contracts\Validation\Factory;

/**
 * Interface Validator
 * @package Validation
 */
interface Validator
{
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
    ): Validator;

    public function errors(): ValidationErrors;

    public function merge(ValidationErrors $errors): ValidationErrors;
}
