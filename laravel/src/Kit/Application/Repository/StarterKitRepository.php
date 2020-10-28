<?php

declare(strict_types=1);

namespace Kit\Application\Repository;

use Kit\Domain\Model\Kit\StarterKit;
use Kit\Domain\Model\Kit\StarterKitList;

/**
 * ハーブ栽培キットリポジトリ
 */
interface StarterKitRepository
{
    /**
     * @return StarterKitList
     */
    public function listAll(): StarterKitList;

    /**
     * @param StarterKit $starterKit
     */
    public function register(StarterKit $starterKit): void;
}
