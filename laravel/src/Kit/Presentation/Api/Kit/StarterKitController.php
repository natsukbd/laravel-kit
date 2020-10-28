<?php

declare(strict_types=1);

namespace Kit\Presentation\Api\Kit;

use Illuminate\Http\JsonResponse;
use Kit\Application\Service\StarterKitRegisterService;
use Kit\Application\Service\StarterKitService;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Model\Kit\StarterKit;
use Kit\Presentation\Api\Controller;

/**
 * API ハーブ栽培キット
 * Class StarterKitController
 * @package Kit\Presentation\Api\Kit
 */
final class StarterKitController extends Controller
{
    /**
     * @var StarterKitService
     */
    private StarterKitService $starterKitService;
    /**
     * @var StarterKitRegisterService
     */
    private StarterKitRegisterService $registerService;

    /**
     * StarterKitController constructor.
     * @param StarterKitService $starterKitService
     * @param StarterKitRegisterService $registerService
     */
    public function __construct(StarterKitService $starterKitService, StarterKitRegisterService $registerService)
    {
        $this->starterKitService = $starterKitService;
        $this->registerService = $registerService;
    }

    /**
     * @OA\Get(
     *     path="/starterkits",
     *     tags={"starterkits"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/StarterKitList")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     ),
     * )
     */
    public function listAll(): JsonResponse
    {
        return response()->json($this->starterKitService->listAll());
    }

    /**
     * @OA\Post(
     *     path="/starterkits",
     *     tags={"starterkits"},
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/KitNumber")
     *         )
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Forbidden"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Not Found"
     *     ),
     *     @OA\RequestBody(
     *         request="VarietyName",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Specification")
     *         )
     *     )
     * )
     * @param StarterKitRegisterRequest $request
     * @return JsonResponse
     * @throws DomainValidationException
     */
    public function register(StarterKitRegisterRequest $request): JsonResponse
    {
        $specification = $request->createSpecification();
        $starterKit = StarterKit::fromSpecification($specification);
        $this->registerService->register($starterKit);
        return response()->json($starterKit->kitNumber(), JsonResponse::HTTP_CREATED);
    }
}
