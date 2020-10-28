<?php

declare(strict_types=1);

namespace Kit\Domain\Validation;

use Illuminate\Support\Collection;
use Illuminate\Support\MessageBag;
use Kit\Domain\Exception\DomainValidationException;

/**
 * Class ValidationErrors
 * @package Kit\Domain\Validation
 */
final class ValidationErrors
{
    /**
     * @var MessageBag
     */
    private MessageBag $errors;

    /**
     * ValidationErrors constructor.
     * @param MessageBag $errors
     */
    private function __construct(MessageBag $errors)
    {
        $this->errors = $errors;
    }

    /**
     * @param MessageBag $errors
     * @return ValidationErrors
     */
    public static function fromMessageBag(MessageBag $errors): ValidationErrors
    {
        return new static($errors);
    }

    /**
     * @param array $errors
     * @return ValidationErrors
     */
    public static function fromArray(array $errors): ValidationErrors
    {
        return new static(new MessageBag($errors));
    }

    /**
     * @param ValidationErrors $errors
     * @return ValidationErrors
     */
    public function merge(ValidationErrors $errors): ValidationErrors
    {
        return self::fromMessageBag(
            $this->errors->merge($errors->messages())
        );
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return $this->errors->getMessages();
    }

    /**
     * @return bool
     */
    public function hasError(): bool
    {
        return $this->errors->isNotEmpty();
    }

    /**
     * @param Collection $items
     * @param string $prefix
     * @return ValidationErrors
     */
    public function addPrefix(Collection $items, string $prefix): ValidationErrors
    {
        $count = 0;
        $errors = self::fromMessageBag($this->errors);
        foreach ($items as $item) {
            $newErrors = [];

            foreach ($item->errors()->messages() as $key => $messages) {
                foreach ($messages as $message) {
                    $newErrors[$prefix . $count . '.' . $key][] = $message;
                }
            }
            $errors = $this->merge(self::fromArray($newErrors));
            $count++;
        }
        return $errors;
    }

    /**
     * @throws DomainValidationException
     */
    public function throwValidationException(): void
    {
        throw DomainValidationException::withMessages($this->errors->messages());
    }
}
