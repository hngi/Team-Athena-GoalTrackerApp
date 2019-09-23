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
        logger('Todo data obtained successfully' . $todos);
        return response()->json(['status' => 'success', 'message' => 'Todo data obtained successfully.', 'data' => $todos->toArray()], 200);
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
                return response()->json(['status' => 'success', 'message' => 'Todo data saved successfully.', 'data' => $todo->toArray()], 200);
            }
            throw new Exception('Failed to save todo' . $request->all());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $todo = Todo::findOrFail($id);
            logger('Showing ' . $todo->task);
            return response()->json(['status' => 'success', 'message' => 'todo detail found.', 'data' => $todo->toArray()], 200);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
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
    public function update(Request $request, $id)
    {
        try {
            $todo = Todo::findOrFail($id)->update($request->all());
            logger($todo->task . ' updated successfully ' . $todo);
            return response()->json(['status' => 'success', 'message' => $todo->task . ' updated successfully', 'data' => $todo->toArray()], 200);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $todo = Todo::findOrFail($id)->delete();
            logger($todo->task . ' deleted successfully ' . $todo);
            return response()->json(['status' => 'success', 'message' => $todo->task . ' deleted successfully', 'data' => $todo->toArray()], 200);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
    }
}
