<?php

declare(strict_types=1);

namespace Kit\Presentation\Api\Kit;

use Illuminate\Http\Request;
use Kit\Application\Service\VarietyRegisterService;
use Kit\Application\Service\VarietyService;
use Kit\Domain\Exception\DomainValidationException;
use Kit\Domain\Model\Kit\Row\Variety;
use Kit\Domain\Model\Kit\Row\VarietyName;
use Kit\Presentation\Api\Controller;
use Illuminate\Http\JsonResponse;

/**
 * API ハーブ品種
 * Class VarietyController
 * @package Kit\Presentation\Api\Kit
 */
final class VarietyController extends Controller
{
    /**
     * @var VarietyService
     */
    private VarietyService $varietyService;
    /**
     * @var VarietyRegisterService
     */
    private VarietyRegisterService $varietyRegisterService;

    /**
     * VarietyController constructor.
     * @param VarietyService $varietyService
     * @param VarietyRegisterService $varietyRegisterService
     */
    public function __construct(VarietyService $varietyService, VarietyRegisterService $varietyRegisterService)
    {
        $this->varietyService = $varietyService;
        $this->varietyRegisterService = $varietyRegisterService;
    }


    /**
     * @OA\Get(
     *     path="/varieties",
     *     tags={"varieties"},
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/Varieties")
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
        return response()->json($this->varietyService->listAll());
    }

    /**
     * @OA\Post(
     *     path="/varieties",
     *     tags={"varieties"},
     *     @OA\Response(
     *         response=201,
     *         description="Created",
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(ref="#/components/schemas/VarietyNumber")
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
     *             @OA\Schema(ref="#/components/schemas/VarietyName")
     *         )
     *     )
     * )
     * @param VarietyRegisterRequest $request
     * @return JsonResponse
     * @throws DomainValidationException
     */
    public function register(VarietyRegisterRequest $request): JsonResponse
    {
        $variety = Variety::fromVarietyName($request->createVarietyName());
        $this->varietyRegisterService->register($variety);
        return response()->json($variety->number(), JsonResponse::HTTP_CREATED);
    }
}
