<?php

namespace App\Http\Controllers;

use App\Models\CaseFile;
use App\Models\Organisation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CaseFileController extends Controller
{
    public function index(): View
    {
        return view('cases.index', [
            'cases' => CaseFile::query()
            ->whereHas('users', function ($query) {
                $query->where('users.id', auth()->id());
            })
            ->latest()
            ->get(['id', 'title', 'status']),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'title' => ['required', 'string', 'max:255'],
        ]);

        $organisation = Organisation::query()->where('name', 'Aretia Advisors')->firstOrFail();

        $case = CaseFile::query()->create([
            'organisation_id' => $organisation->id,
            'title' => $data['title'],
            'status' => 'open',
        ]);

        $case->users()->attach($request->user()->id);

        return redirect()->route('cases.index');
    }

    public function show(CaseFile $caseFile): View
    {
        $this->authorize('view', $caseFile);
        $caseFile->load(['subject.aliases', 'subject.addresses']);

        return view('cases.show', [
            'caseFile' => $caseFile,
        ]);
    }

    public function storeSubject(Request $request, CaseFile $caseFile): RedirectResponse
    {
        $this->authorize('view', $caseFile);
        $data = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['nullable', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'ssn_masked' => ['required', 'string', 'max:11'],
            'date_of_birth' => ['nullable', 'date'],
            'gender' => ['nullable', 'string', 'max:50'],
            'age' => ['nullable', 'integer', 'min:0', 'max:130'],
            'employer' => ['nullable', 'string', 'max:255'],
        ]);

        $caseFile->subject()->updateOrCreate(
            ['case_file_id' => $caseFile->id],
            $data,
        );

        return redirect()->route('cases.show', $caseFile)->with('status', 'Subject saved.');
    }


    public function storeAlias(Request $request, CaseFile $caseFile): RedirectResponse
    {
        $this->authorize('view', $caseFile);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $caseFile->subject()->firstOrFail()->aliases()->create($data);

        return redirect()->route('cases.show', $caseFile)->with('status', 'Alias saved.');
    }

    public function storeAddress(Request $request, CaseFile $caseFile): RedirectResponse
    {
        $this->authorize('view', $caseFile);
        $data = $request->validate([
            'line' => ['required', 'string', 'max:255'],
        ]);

        $caseFile->subject()->firstOrFail()->addresses()->create($data);

        return redirect()->route('cases.show', $caseFile)->with('status', 'Address saved.');
    }

    public function storeRelative(Request $request, CaseFile $caseFile): RedirectResponse
    {
        $this->authorize('view', $caseFile);
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'relation' => ['required', 'string', 'max:255'],
        ]);

        $caseFile->subject()->firstOrFail()->relatives()->create($data);

        return redirect()->route('cases.show', $caseFile)->with('status', 'Relative saved.');
    }
}