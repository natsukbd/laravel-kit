<?php

declare(strict_types=1);

namespace Kit\Infrastructure\Validation;

use Illuminate\Contracts\Validation\Factory;
use Validation\Validator;

/**
 * Class DataValidatorFactory
 * @package Kit\Infrastructure\Validation
 */
final class DataValidatorFactory
{
    /**
     * @var Factory
     */
    private Factory $factory;

    /**
     * DataValidatorFactory constructor.
     * @param Factory $factory
     */
    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

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
    ): Validator {
        return DataValidator::create(
            $this->factory,
            $data,
            $rules,
            $messages,
            $customAttributes
        );
    }
}
