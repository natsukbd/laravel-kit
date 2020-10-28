<?php

declare(strict_types=1);

namespace Kit\Application\Service;

use Kit\Application\Repository\StarterKitRepository;
use Kit\Domain\Model\Kit\StarterKitList;

/**
 * Class StarterKitService
 * @package Kit\Application\Service
 */
final class StarterKitService
{
    /**
     * @var StarterKitRepository
     */
    private StarterKitRepository $starterKitRepository;

    /**
     * StarterKitService constructor.
     * @param StarterKitRepository $starterKitRepository
     */
    public function __construct(StarterKitRepository $starterKitRepository)
    {
        $this->starterKitRepository = $starterKitRepository;
    }

    /**
     * ハーブ栽培キットを一覧する
     * @return StarterKitList
     */
    public function listAll(): StarterKitList
    {
        return $this->starterKitRepository->listAll();
    }
}
