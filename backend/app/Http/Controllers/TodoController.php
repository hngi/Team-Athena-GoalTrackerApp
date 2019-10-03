<?php

namespace App\Http\Controllers;

use App\Http\Requests\TodoRequest;
use App\Todo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function add(Request $request){
        try{
            $todo = Todo::create(['goal_id'=>$request->goal_id, 'todo'=>$request->todo, 'completed'=>false]);
            if($todo) return $this->success();
        }catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function remove(Request $request){
        try{
            $todo = Todo::find($request->todo_id);
            if($todo){
                $todo->delete();
            }
            return $this->success();
        }catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function complete(Request $request){
        try{
            $todo = Todo::find($request->todo_id);
            if($todo)  {
                $todo->completed = $request->is_done;
                $todo->save();
            }
            return $this->success();
        }catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $todos = Todo::orderBy('created_at','desc')->get();
        logger('Todo data obtained successfully');
        return view('todos.index', compact('todos'));
        // return response()->json(['status' => 'success', 'message' => 'Todo data obtained successfully.', 'data' => $todos->toArray()], 200);
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
                return $this->success('Todo data saved successfully.', $todo->toArray());
            }
            throw new Exception('Failed to save todo' . $request->all());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->error($e->getMessage(), 500);
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
            return $this->success('todo detail found.', $todo->toArray());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->error($e->getMessage(), 500);
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
    public function update(TodoRequest $request, $id)
    {
        try {
            $todo = Todo::findOrFail($id)->update($request->all());
            logger($todo->task . ' updated successfully ' . $todo);
            return $this->success($todo->task . ' updated successfully', $todo->toArray());
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return $this->error($e->getMessage(), 500);
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
            return $this->success($todo->task . ' deleted successfully', $todo->toArray());
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }
}
