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
        return response()->json(['status' => 'success', 'message' => 'Goal data obtained successfully.', 'data' => Goal::getGoalsWithTodos()], 200);
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
                return response()->json(['status' => 'success', 'message' => 'Goal saved successfully.', 'data' => $goal->toArray()], 200);
            }
            throw new Exception('Failed to save goal' . $request->all());
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
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
            return response()->json(['status' => 'success', 'message' => 'goal detail found.', 'data' => $goal->toArray()], 200);
        } catch (Exception $e) {
            logger()->error($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
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
            logger($goal->tile . ' updated successfully ' . $goal);
            return response()->json(['status' => 'success', 'message' => $goal->title . ' updated successfully', 'data' => $goal->toArray()], 200);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
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
            return response()->json(['status' => 'success', 'message' => $goal->title . ' deleted successfully', 'data' => $goal->toArray()], 200);
        } catch (Exception $e) {
            Log::warning($e->getMessage());
            return response()->json(['status' => 'failed', 'message' => $e->getMessage()], 500);
        }
    }
}
