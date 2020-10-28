<?php

declare(strict_types=1);

namespace Validation;

/**
 * Interface ValidatorFactory
 * @package Kit\Validation
 */
interface ValidatorFactory
{
    /**
     * @param array $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return Validator
     */
    public function create(
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ): Validator;
}
