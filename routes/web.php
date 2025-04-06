<?php

use App\Models\Task as ModelsTask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

class Task
{
  public function __construct(
    public int $id,
    public string $title,
    public string $description,
    public ?string $long_description,
    public bool $completed,
    public string $created_at,
    public string $updated_at
  ) {
  }
}

Route::get("/", function() {
    return redirect()->route("tasks.index");
});

Route::get('/tasks', function () {
    return view("index", [
        "tasks" => ModelsTask::latest()->get(),
    ]);
})->name("tasks.index");

Route::view("/tasks/create", "create")->name("tasks.create");

Route::get("/tasks/{id}", function ($id)  {
    return view("show", [
        "task" => ModelsTask::findOrFail($id)
    ]);
})->name("tasks.show");

Route::post("/tasks", function(Request $request) {
    dd($request->all());
})->name("tasks.store");

Route::fallback(function () {
    return "Still got somewhere!";
});
