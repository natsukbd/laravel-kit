<?php

declare(strict_types=1);

namespace Validation;

trait UsingValidator
{
    /**
     * @var Validator
     */
    protected Validator $validator;

    /**
     * @param array<string, array<string, string|null|array>|int> $data
     * @param array $rules
     * @param array $messages
     * @param array $customAttributes
     * @return void
     */
    protected function validator(
        array $data,
        array $rules,
        array $messages = [],
        array $customAttributes = []
    ): void {
        /** @var ValidatorFactory $factory */
        $factory = app(ValidatorFactory::class);
        $this->validator = $factory->create($data, $rules, $messages, $customAttributes);
    }
}
