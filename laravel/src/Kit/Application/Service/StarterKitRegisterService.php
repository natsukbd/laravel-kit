<?php

declare(strict_types=1);

namespace Kit\Application\Service;

use Kit\Application\Repository\StarterKitRepository;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Model\Kit\StarterKit;

/**
 * ハーブ栽培キット登録サービス
 * Class StarterKitRegisterService
 * @package Kit\Application\Service
 */
final class StarterKitRegisterService
{
    /**
     * @var StarterKitRepository
     */
    private StarterKitRepository $starterKitRepository;

    /**
     * StarterKitRegisterService constructor.
     * @param StarterKitRepository $starterKitRepository
     */
    public function __construct(StarterKitRepository $starterKitRepository)
    {
        $this->starterKitRepository = $starterKitRepository;
    }

    /**
     * ハーブ栽培キットを登録する
     * @param StarterKit $starterKit
     * @throws DomainValidationException
     */
    public function register(StarterKit $starterKit): void
    {
        $starterKit->validate();
        $this->starterKitRepository->register($starterKit);
    }
}
