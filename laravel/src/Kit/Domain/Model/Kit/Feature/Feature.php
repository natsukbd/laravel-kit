<?php

declare(strict_types=1);

namespace Kit\Domain\Model\Kit\Feature;

use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\In;
use MyCLabs\Enum\Enum;

/**
 * Class Feature
 * @package Kit\Domain\Model\Kit\Feature
 * @method static Feature 専用培養士()
 * @method static Feature 肥料()
 * @method static Feature PH調整剤()
 *
 * @OA\Schema(
 *   description="特徴",
 *   type="string",
 *   enum = {"専用培養士", "肥料", "PH調整剤"},
 * )
 */
final class Feature extends Enum
{
    public const 専用培養士 = '専用培養士';
    public const 肥料 = '肥料';
    public const PH調整剤 = 'PH調整剤';

    /**
     * @return array<int, In|string>
     */
    public static function rules(): array
    {
        return  ['required', 'string', Rule::in(self::toArray())];
    }
}
