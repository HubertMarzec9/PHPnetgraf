<?php

namespace App\Http\Controllers;

use App\Http\Requests\PetCreateRequest;
use App\Http\Requests\PetUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    protected mixed $apiUrl;

    public function __construct()
    {
        $this->apiUrl = env('API_URL');
    }

    public function findById(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $id = $request->input('id');
        $response = Http::get("{$this->apiUrl}/$id");

        return $response->successful()
            ? $this->handleFindByIdSuccess($response, $request)
            : $this->handleErrorResponse($response->status());
    }

    public function findByStatus(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $status = $request->input('status');
        $response = Http::get("{$this->apiUrl}/findByStatus?status={$status}");

        return $response->successful()
            ? $this->handleFindByStatusSuccess($response)
            : $this->handleErrorResponse($response->status());
    }

    public function destroy(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $id = $request->input('id');
        $response = Http::delete("{$this->apiUrl}/$id");

        return $response->successful()
            ? $this->handleSuccessResponse('Pet deleted successfully')
            : $this->handleErrorResponse($response->status());
    }

    public function update(PetUpdateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data = $this->preparePetData($request);

        $response = Http::asJson()->put("{$this->apiUrl}", $data);

        return $response->successful()
            ? $this->handleSuccessResponse('Pet updated successfully')
            : $this->handleErrorResponse($response->status());
    }

    public function add(PetCreateRequest $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        $data = $this->preparePetData($request);
        $response = Http::asJson()->post("{$this->apiUrl}", $data);


        return $response->successful()
            ? $this->handleSuccessResponse('Pet added successfully')
            : $this->handleErrorResponse($response->status(), ['405' => 'Invalid input']);
    }

    protected function handleFindByIdSuccess($response, $request): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $pet = $response->json();

        if (pathinfo(parse_url($request->headers->get('referer'), PHP_URL_PATH), PATHINFO_BASENAME) === 'get') {
            return view('pet.show', compact('pet'));
        } else {
            return view('put', compact('pet'));
        }
    }

    protected function handleFindByStatusSuccess($response): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $pets = $response->json();
        return view('pets.show', compact('pets'));
    }

    protected function preparePetData(Request $request): array
    {
        $id = $request->input('id');
        $name = $request->input('name') ?? "";
        $status = $request->input('status') ?? "";
        $tags = $request->input('tags') ?? "";
        $categoryId = $request->input('categoryId') ?? "";
        $categoryName = $request->input('categoryName') ?? "";
        $photoUrls = $request->input('photoUrls') ?? "";

        return [
            'id' => $id,
            'category' => [
                'id' => $categoryId,
                'name' => $categoryName
            ],
            'name' => $name,
            'photoUrls' => $photoUrls,
            'tags' => $tags,
            'status' => $status,
        ];
    }

    protected function handleSuccessResponse($message): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('welcome', ['response' => $message]);
    }

    protected function handleErrorResponse($errorCode, $customMessages = []): \Illuminate\Http\RedirectResponse
    {

        $errorMessages = [
            400 => 'Invalid ID supplied',
            404 => 'Pet not found',
            405 => 'Validation exception',
        ];

        $error = $customMessages[$errorCode] ?? $errorMessages[$errorCode] ?? 'Unknown Error ' . $errorCode;

        return redirect()->route('error')->withErrors(['error' => $error]);
    }
}
