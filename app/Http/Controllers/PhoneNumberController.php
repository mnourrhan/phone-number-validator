<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexingPhoneNumberRequest;
use App\Services\IndexingPhoneNumbersService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

/**
 * Class PhoneNumberController
 * @package App\Http\Controllers
 */

class PhoneNumberController extends Controller
{
    /**
     * @param IndexingPhoneNumberRequest $request
     * @param IndexingPhoneNumbersService $service
     * @return Application|Factory|View
     */
    public function index(IndexingPhoneNumberRequest $request,
                          IndexingPhoneNumbersService $service) {
        $data = $service->execute();
        return view('phone-list.index', $data);
    }
}
