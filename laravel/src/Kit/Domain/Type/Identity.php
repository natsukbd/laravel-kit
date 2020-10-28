<?php

declare(strict_types=1);

namespace Kit\Domain\Type;

use Exception;
use Ramsey\Uuid\Uuid;

final class Identity
{
    /**
     * @var string
     */
    private string $format;

    /**
     * Identity constructor.
     * @param string $format
     */
    public function __construct(string $format)
    {
        $this->format = $format;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function generate(): string
    {
        $source = mb_strtoupper(Uuid::uuid4()->toString());
        $elements = explode('-', mb_substr($source, 4, 24));
        return vsprintf($this->format, $elements);
    }
}
