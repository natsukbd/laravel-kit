<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Row;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Collection;
use Validation\UsingValidator;
use Kit\Domain\Validation\ValidationErrors;

/**
 * Class Rows
 * @package Kit\Domain\Model\Kit\Row
 * @OA\Schema(
 *     title="Rows",
 *     description="すべての列",
 * )
 */
final class Rows implements Arrayable
{
    use UsingValidator;

    /**
     * @OA\Property(
     *     @OA\Items(ref="#/components/schemas/Row")
     * )
     * @var Collection
     */
    private Collection $list;

    /**
     * Rows constructor.
     * @param Collection $list
     */
    private function __construct(Collection $list)
    {
        $this->list = $list->map(
            static function (Row $row) {
                return $row;
            }
        );

        $this->validator(
            ['rows' => ['list' => $this->list->toArray()]],
            ['rows.list' => $this->rules()]
        );
    }

    /**
     * @param array $rows
     * @return Rows
     */
    public static function fromArray(array $rows): Rows
    {
        $list = Collection::make();
        foreach ($rows as $row) {
            $list->push(
                new Row(
                    Variety::fromVarietyName(
                        new VarietyName($row['variety']['varietyName']['value'])
                    ),
                    $row['seedsPerCell']
                )
            );
        }
        return new static($list);
    }

    /**
     * @return array<int, string>
     */
    public function rules(): array
    {
        return ['required'];
    }

    /**
     * @return ValidationErrors
     */
    public function errors(): ValidationErrors
    {
        return $this->validator
            ->errors()
            ->addPrefix($this->list, 'rows.list.');
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'list' => $this->list->map(
                static function (Row $row) {
                    return $row->toArray();
                }
            )
        ];
    }
}
