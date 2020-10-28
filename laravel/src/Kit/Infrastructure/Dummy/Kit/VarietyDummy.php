<?php

declare(strict_types=1);

namespace Kit\Infrastructure\Dummy\Kit;

use Illuminate\Support\Collection;
use Kit\Application\Repository\VarietyRepository;
use Kit\Domain\Model\Kit\Row\Varieties;
use Kit\Domain\Model\Kit\Row\Variety;
use Kit\Domain\Model\Kit\Row\VarietyName;

final class VarietyDummy implements VarietyRepository
{
    /**
     * @return Varieties
     */
    public function listAll(): Varieties
    {
        return new Varieties(
            Collection::make(
                [
                    Variety::fromVarietyName(new VarietyName('name1')),
                    Variety::fromVarietyName(new VarietyName('name2'))
                ]
            )
        );
    }

    /**
     * @param Variety $variety
     */
    public function register(Variety $variety): void
    {
        // TODO: Implement register() method.
    }
}
