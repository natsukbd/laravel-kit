<?php

declare(strict_types=1);

namespace Kit\Application\Service;

use Kit\Application\Repository\VarietyRepository;
use Kit\Domain\Model\Kit\Row\Varieties;

/**
 * Class VarietyService
 * @package Kit\Application\Service
 */
final class VarietyService
{
    /**
     * @var VarietyRepository
     */
    private VarietyRepository $varietyRepository;

    /**
     * VarietyService constructor.
     * @param VarietyRepository $varietyRepository
     */
    public function __construct(VarietyRepository $varietyRepository)
    {
        $this->varietyRepository = $varietyRepository;
    }

    public function listAll(): Varieties
    {
        return $this->varietyRepository->listAll();
    }
}
