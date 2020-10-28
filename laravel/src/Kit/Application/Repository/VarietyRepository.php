<?php

declare(strict_types=1);

namespace Kit\Application\Repository;

use Kit\Domain\Model\Kit\Row\Varieties;
use Kit\Domain\Model\Kit\Row\Variety;

/**
 * ハーブ品種リポジトリ
 * Interface VarietyRepository
 * @package Kit\Application\Repository
 */
interface VarietyRepository
{
    /**
     * @param Variety $variety
     */
    public function register(Variety $variety): void;

    /**
     * @return Varieties
     */
    public function listAll(): Varieties;
}
