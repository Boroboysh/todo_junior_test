<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tasks = Task::where("user_id", Auth::id())->get();
        $sortTo = $request->query('sortTo');

        if ($sortTo) {
            $order = $request->query('order') ?? 'desc';

            $sortedTasks = $tasks->sortBy([
                [$sortTo, $order]
            ]);

            return view('todo.tasks', ['tasks' => $sortedTasks]);
        }

        return view('todo.tasks', ['tasks' => $tasks]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData);
        }

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $task = Task::where('user_id', Auth::id())->find($id);

        if ($task) {
            return view('todo.task', ['task' => $task]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Server error',
        ], 500);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('todo.edit', ['task' => Task::where('user_id', Auth::id())->find($id)]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validateData = Validator::make($request->all(), [
            'title' => 'required|string',
            'description' => 'nullable|string',
            'status' => 'required|boolean',
        ]);

        if ($validateData->fails()) {
            return redirect()->back()->withErrors($validateData);
        }

        $task = Task::where('user_id', Auth::id())->find($id)->update($request->except('_method', '_token'));

        if ($task) {
            return redirect()->route('todo.index');
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Обновляемой записи не существует',
        ], 500);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $status = Task::where('user_id', Auth::id())->find($id)->delete();

        if ($status) {
            return redirect()->back()->with('success', 'Deleted Todo');
        }
        return response()->json([
            'status' => 'error',
            'message' => 'Удаляемой записи не существует'
        ], 404);
    }

}
