<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConferenceStoreRequest;
use App\Http\Requests\ConferenceUpdateRequest;
use App\Models\Conference;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ConferenceController extends Controller
{
    public function index(Request $request): View
    {
        $conferences = Conference::all();

        return view('conference.index', compact('conferences'));
    }

    public function create(Request $request): View
    {
        return view('conference.create');
    }

    public function store(ConferenceStoreRequest $request): RedirectResponse
    {
        $conference = Conference::create($request->validated());

        $request->session()->flash('conference.id', $conference->id);

        return redirect()->route('conference.index');
    }

    public function show(Request $request, Conference $conference): View
    {
        return view('conference.show', compact('conference'));
    }

    public function edit(Request $request, Conference $conference): View
    {
        return view('conference.edit', compact('conference'));
    }

    public function update(ConferenceUpdateRequest $request, Conference $conference): RedirectResponse
    {
        $conference->update($request->validated());

        $request->session()->flash('conference.id', $conference->id);

        return redirect()->route('conference.index');
    }

    public function destroy(Request $request, Conference $conference): RedirectResponse
    {
        $conference->delete();

        return redirect()->route('conference.index');
    }
}
