<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class Varieties
 * @package Kit\Domain\Model\Kit\Row
 * @OA\Schema(
 *     description="ハーブ品種一覧"
 * )
 */
final class Varieties implements Arrayable
{
    /**
     * @OA\Property(
     *     @OA\Items(ref="#/components/schemas/Variety")
     * )
     * @var Collection
     */
    private Collection $list;

    /**
     * StarterKitList constructor.
     * @param Collection $list
     */
    public function __construct(Collection $list)
    {
        $this->list = $list->map(
            static function (Variety $variety) {
                return $variety;
            }
        );
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'list' => $this->list->map(
                static function (Variety $variety) {
                    return $variety->toArray();
                }
            )->toArray()
        ];
    }
}
