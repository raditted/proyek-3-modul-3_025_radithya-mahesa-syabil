<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreActivityRequest;
use App\Http\Requests\UpdateActivityRequest;
use App\Models\Activity;
use App\Services\ActivityService;
use DomainException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ActivityController extends Controller
{
    public function index(Request $request): View
    {
        $activities = Activity::query()
            ->filter($request->only(['search', 'category_id', 'status', 'sort']))
            ->paginate(10)
            ->withQueryString();

        return view('activities.index', compact('activities'));
    }

    public function create(): View
    {
        return view('activities.create');
    }

    public function store(StoreActivityRequest $request, ActivityService $service): RedirectResponse
    {
        $activity = $service->create($request->validated());

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil dibuat.');
    }

    public function show(Activity $activity): View
    {
        return view('activities.show', compact('activity'));
    }

    public function edit(Activity $activity): View
    {
        return view('activities.edit', compact('activity'));
    }

    public function update(UpdateActivityRequest $request, Activity $activity, ActivityService $service): RedirectResponse
    {
        try {
            $service->update($activity, $request->validated());
        } catch (DomainException $exception) {
            return back()
                ->withErrors(['status' => $exception->getMessage()])
                ->withInput();
        }

        return to_route('activities.show', $activity)
            ->with('success', 'Kegiatan berhasil diperbarui.');
    }

    public function restore(int $id): RedirectResponse
    {
        $activity = Activity::onlyTrashed()->findOrFail($id);
        $activity->restore();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dipulihkan.');
    }

    public function destroy(Activity $activity): RedirectResponse
    {
        $activity->delete();

        return to_route('activities.index')
            ->with('success', 'Kegiatan berhasil dihapus.');
    }
}
