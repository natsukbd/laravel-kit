<?php

declare(strict_types=1);

namespace Kit\Domain\Type;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use MyCLabs\Enum\Enum;

/**
 * Class Covered
 * @package Kit\Domain\Type
 * @method static Covered 有()
 * @method static Covered 無()
 * @OA\Schema(
 *   description="カバー有無",
 *   type="string",
 *   enum = {"有", "無"},
 * )
 */
final class Covered extends Enum
{
    private const 有 = '有';
    private const 無 = '無';

    /**
     * @return array<int, In|string>
     */
    public static function rules(): array
    {
        return ['required', 'string', Rule::in(self::toArray())];
    }
}
