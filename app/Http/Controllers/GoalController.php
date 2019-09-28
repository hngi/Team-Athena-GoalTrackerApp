<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Todo;
use App\Http\Requests\GoalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GoalController extends Controller
{
    public function goals(){
        return $this->success('Goals retrieved', Goal::getGoalsWithTodos());
    }

    public function add(Request $request){
        try{
            $goal = Goal::create(['user_id'=>1, 'goal'=>$request->goal]);
            if($goal) return $this->success();
        }catch (Exception $e) {
            return $this->error($e->getMessage(), 500);
        }
    }
    public function remove(Request $request){
        try{
            $goal = Goal::find($request->goalId);
            if($goal){
                $goal->delete();
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
        logger('requesting for goals data');
        return $this->success('Goal data obtained successfully.', Goal::getGoalsWithTodos());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GoalRequest $request)
    {
        try {
            $goal = Goal::create($request->all());
            if ($goal) {
                logger('Goal saved successfully ' . $goal, );
                return $this->success('Goal saved successfully.', $goal->toArray());
            }
            throw new Exception('Failed to save goal' . $request->all());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $goal = Goal::findOrFail($id);
            logger('Showing ' . $goal->title);
            return $this->success('goal detail found.', $goal->toArray());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function edit(Goal $goal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function update(GoalRequest $request, $id)
    {
        try {
            $goal = Goal::findOrFail($id)->update($request->all());
            logger($goal->title . ' updated successfully ' . $goal);
            return $this->success($goal->title . ' updated successfully', $goal->toArray());
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Goal  $goal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $goal = Goal::findOrFail($id)->delete();
            logger($goal->title . ' deleted successfully ' . $goal);
            return $this->success($goal->title . ' deleted successfully', $goal->toArray());
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return $this->error($e->getMessage(), 500);
        }
    }

    public function statistics(){
        $stats = [
            'totalGoals'=>Goal::where('user_id', 1)->count(),
            'totalTodos'=>Goal::join('todos', 'todos.goal_id', 'goals.id')->where('goals.user_id', 1)->count(),
            'pendingTodos'=>Goal::join('todos', 'todos.goal_id', 'goals.id')->where(['goals.user_id'=>1, 'todos.completed'=>0])->count(),
            'completedTodos'=>Goal::join('todos', 'todos.goal_id', 'goals.id')->where(['goals.user_id'=>1,'todos.completed'=>1])->count()

            // 'totalGoals'=>Goal::where('user_id', Auth::user()->id)->count(),
            // 'totalTodo'=>Goal::join('todos', 'todos.goal_id', 'goals.id')->where('goals.user_id', Auth::user()->id)->count(),
            // 'pendingTodo'=>Todo::where(['user_id'=>Auth::user()->id, 'completed'=>0])->count(),
            // 'completedTodo'=>Todo::where(['user_id'=>Auth::user()->id,'completed'=>1])->count() 

            // 'pendingTodo'=>Todo::where(['user_id'=>Auth::user()->id, 'status'=>'Pending'])->count(),
            // 'completedTodo'=>Todo::where(['user_id'=>Auth::user()->id,'status'=>'Completed'])->count() 
        ];
        return $this->success('statistics retrieved', $stats);
    }
}
