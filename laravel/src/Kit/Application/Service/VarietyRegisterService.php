<?php

declare(strict_types=1);

namespace Kit\Application\Service;

use Kit\Application\Repository\VarietyRepository;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Model\Kit\Row\Variety;

/**
 * ハーブ品種の登録サービス
 * Class VarietyRegisterService
 * @package Kit\Application\Service
 */
final class VarietyRegisterService
{
    /**
     * @var VarietyRepository
     */
    private VarietyRepository $varietyRepository;

    /**
     * VarietyRegisterService constructor.
     * @param VarietyRepository $varietyRepository
     */
    public function __construct(VarietyRepository $varietyRepository)
    {
        $this->varietyRepository = $varietyRepository;
    }

    /**
     * ハーブ品種を登録する
     * @param Variety $variety
     * @throws DomainValidationException
     */
    public function register(Variety $variety): void
    {
        $variety->validate();
        $this->varietyRepository->register($variety);
    }
}
