@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Todos</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form>
                        <input type="hidden" name="goal_id" value="1">
                        @csrf
                    <div class="form-group">
                        <label>Action</label>
                            <input type="text" class="form-control dt" id="task" name="task" placeholder="Working out">
                        </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>
                    <button class="btn btn-success" id="create">Add To Goal</button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">View Todos</div>
                <div class="card-body">
                        <div class="table-responsive">
                                <table class="table table-striped b-t">
                                  <thead>
                                    <tr>
                                      <th style="width:20px;">
                                          <input type="checkbox"><i></i>
                                      </th>
                                      <th>Action</th>
                                      <th style="width:50px">Details</th>
                                    </tr>
                                  </thead>
                                  <tbody id="todo">
                                        @foreach ($todos as $todo)
                                    <tr id="todo_id_{{ $todo->id }}">
                                        <td><input type="checkbox">
                                            <i class="dark-white"></i>
                                        </td>
                                        <td>{{$todo->task}}</td>

                                        <td style="width:200px">
                                                <a href="javascript:void(0)" class="btn btn-outline-info btn-xs" data-id="{{$todo->id}}" title="View Todo">
                                                    <i class="fa fa-plus"></i> View 
                                                </a>
                                                <a href="javascript:void(0)" class="btn btn-outline-warning btn-xs" data-id="{{$todo->id}}" title="Edit Todo">
                                                        <i class="fa fa-plus"></i> Edit
                                                    </a>
                                                <a href="javascript:void(0)" class="btn btn-outline-danger btn-xs delete" data-id="{{$todo->id}}"title="Delete Todo" >
                                                        <i class="fa fa-plus"></i> Del 
                                                    </a>
                                      </td>
                                    </tr>
                                    @endforeach
                                  </tbody>
                                </table>
                </div>
            </div>
        </div>
        
    </div> 
</div>
@push('additions')
<script src="{{ asset('js/todo.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@8"></script>
@endpush
@endsection
