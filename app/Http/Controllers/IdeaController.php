<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class IdeaController extends Controller
{ 
    use AuthorizesRequests;

    public function index(Request $request)
    {
        $user = $request->user();
        $search = $request->input('search');

        if ($search != '') {
            $ideas = $user->ideas()->where(function ($query) use ($search) {
                    $query->where('title', 'like', "%{$search}%")->orWhere('description', 'like', "%{$search}%");
                })->get();
        } else {
            $ideas = $user->ideas;
        }

        return view('pages.dashboard', ["ideas" => $ideas, "nbIdeas" => $ideas->Count()]);
    }

    public function create()
    {
        return view('idea.create_idea');
    }

    public function store(Request $request)
    {
        $user = $request->user();

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:100', 'min:5'],
            'description' => ['required', 'string', 'max:150'],
        ]); 

        $user->ideas()->create($validated);
        return redirect()->route('idea.index')->with('success', 'Idée créée avec succès.');
    }

    public function edit(Idea $idea)
    {
        $this->authorize('update', $idea);

        return view('idea.edit_idea', ['idea' => $idea]);
    }

    public function update(Request $request, Idea $idea)
    {
        $this->authorize('update', $idea);

            $validated = $request->validate([
                'title' => ['required', 'string', 'max:100', 'min:5'],
                'description' => ['required', 'string', 'max:150'],
                'status' => ['required', 'in:Soumise,En attente,En traitement'],
            ]); 

        $idea->update($validated);
        return redirect()->route('idea.index')->with('success', 'Idée modifiée avec succès.');
    }

    public function destroy(Idea $idea)
    {
        $this->authorize('delete', $idea);

        $idea->delete();
        return redirect()->route('idea.index')->with('success', 'Idée supprimée avec succès.');
    }
}
