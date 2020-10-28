<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class StarterKitList
 * @package Kit\Domain\Model\Kit
 * @OA\Schema(
 *     description="栽培キット一覧",
 * )
 */
final class StarterKitList implements Arrayable
{
    /**
     * @OA\Property(
     *     @OA\Items(ref="#/components/schemas/StarterKit")
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
            static function (StarterKit $feature) {
                return $feature;
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
                static function (StarterKit $starterKit) {
                    return $starterKit->toArray();
                }
            )->toArray()
        ];
    }
}
