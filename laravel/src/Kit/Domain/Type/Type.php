<?php

declare(strict_types=1);

namespace Kit\Domain\Type;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use MyCLabs\Enum\Enum;

/**
 * Class Type
 * @package Kit\Domain\Type
 * @method static Type プラスチック()
 * @method static Type 木製()
 * @OA\Schema(
 *   description="カバープラスチック木製",
 *   type="string",
 *   enum = {"プラスチック", "木製"},
 * )
 */
final class Type extends Enum
{
    private const プラスチック = 'プラスチック';
    private const 木製 = '木製';

    /**
     * @return array<int, In|string>
     */
    public static function rules(): array
    {
        return ['required', 'string', Rule::in(self::toArray())];
    }
}
