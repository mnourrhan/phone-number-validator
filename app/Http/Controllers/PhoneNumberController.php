<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexingPhoneNumberRequest;
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
     * @return Application|Factory|View
     */
    public function index(IndexingPhoneNumberRequest $request) {
        return view('welcome');
    }
}
