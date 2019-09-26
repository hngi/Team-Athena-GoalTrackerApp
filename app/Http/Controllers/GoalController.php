<?php

namespace App\Http\Controllers;

use App\Goal;
use App\Http\Requests\GoalRequest;
use Illuminate\Http\Request;

class GoalController extends Controller
{
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
}
