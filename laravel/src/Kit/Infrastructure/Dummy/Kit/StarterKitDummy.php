<?php

declare(strict_types=1);

namespace Kit\Infrastructure\Dummy\Kit;

use Exception;
use Illuminate\Support\Collection;
use Kit\Application\Repository\StarterKitRepository;
use Kit\Domain\Model\Kit\Feature\Feature;
use Kit\Domain\Model\Kit\Feature\Features;
use Kit\Domain\Model\Kit\Row\Rows;
use Kit\Domain\Model\Kit\Specification\DateOfSeed;
use Kit\Domain\Model\Kit\Specification\Specification;
use Kit\Domain\Model\Kit\StarterKit;
use Kit\Domain\Model\Kit\StarterKitList;
use Kit\Domain\Type\Covered;
use Kit\Domain\Type\Type;

final class StarterKitDummy implements StarterKitRepository
{
    /**
     * @return StarterKitList
     * @throws Exception
     */
    public function listAll(): StarterKitList
    {
        return new StarterKitList(
            Collection::make(
                [
                    StarterKit::fromSpecification(
                        new Specification(
                            DateOfSeed::today(),
                            Covered::有(),
                            Type::プラスチック(),
                            Features::fromArray(
                                [
                                    Feature::専用培養士(),
                                    Feature::PH調整剤()
                                ]
                            ),
                            Rows::fromArray(
                                [
                                    [
                                        'variety' => ['varietyName' => ['value' => '品種名']],
                                        'seedsPerCell' => 1
                                    ]
                                ]
                            )
                        )
                    )
                ]
            )
        );
    }

    /**
     * @param StarterKit $starterKit
     */
    public function register(StarterKit $starterKit): void
    {
        // TODO: Implement register() method.
    }
}
