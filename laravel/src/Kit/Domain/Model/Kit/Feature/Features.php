<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Feature;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;

/**
 * Class Features
 * @package Kit\Domain\Model\Kit\Feature
 * @OA\Schema(
 *     description="特徴",
 * )
 */
final class Features implements Arrayable
{
    /**
     * @OA\Property(
     *     @OA\Items(ref="#/components/schemas/Feature")
     * )
     * @var Collection
     */
    private Collection $list;

    /**
     * Features constructor.
     * @param Collection $list
     */
    private function __construct(Collection $list)
    {
        $this->list = $list->map(
            static function (Feature $feature) {
                return $feature;
            }
        );
    }

    /**
     * @return  array<int, string>
     */
    public static function rules(): array
    {
        return ['array'];
    }

    /**
     * @param array $features
     * @return Features
     */
    public static function fromArray(array $features = []): Features
    {
        $list = Collection::make();
        foreach ($features as $feature) {
            $list->push(new Feature($feature));
        }
        return new static($list);
    }

    /**
     * @return string
     */
    public function show(): string
    {
        return $this->list->map(
            static function (Feature $feature) {
                return $feature->getValue();
            }
        )->join('、');
    }

    /**
     * @return bool
     */
    public function hasFeatures(): bool
    {
        return $this->list->isNotEmpty();
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'list' => $this->list->map(
                static function (Feature $feature) {
                    return $feature;
                }
            )->toArray()
        ];
    }
}
