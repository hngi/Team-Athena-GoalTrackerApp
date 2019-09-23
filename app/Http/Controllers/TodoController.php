<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($request)
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TodoRequest $request)
    {
        try {
            $todo = Todo::create($request->all());
            if ($todo) {
                logger('Todo data saved successfully ' . $todo);
                return redirect()->back();
            }
            throw new Exception('Failed to save todo' . $request->all());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show(Todo $todo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function edit(Todo $todo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        try {
            Todo::findOrFail($todo->id)->update($request->all());
            logger($todo->task+'Updated successfully ' . $todo);
            return redirect()->back();
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        try {
            $todo = Todo::findOrFail($todo->id)->delete();
            logger($todo->task . ' deleted successfully ' . $todo);
            return redirect()->back();
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return redirect()->back()->withErrors($e->getMessage());
        }
    }
}
