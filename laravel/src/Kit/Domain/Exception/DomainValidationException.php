<?php

declare(strict_types=1);

namespace Kit\Domain\Exception;

use Illuminate\Validation\ValidationException;

/**
 * Interface DomainValidationException
 * @package Kit\Domain\Exception
 */
final class DomainValidationException extends ValidationException
{
}
