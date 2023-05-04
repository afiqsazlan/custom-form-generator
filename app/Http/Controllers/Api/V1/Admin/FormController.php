<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Models\Form;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function create(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'inputs' => 'required|array|min:1',
            'inputs.*.type' => 'required|string',
            'inputs.*.label' => 'required|string',
        ]);

        $form = new Form();
        $form->title = $validatedData['title'];
        $form->inputs = $validatedData['inputs'];
        $form->save();
    }
}
