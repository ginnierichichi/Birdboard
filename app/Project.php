<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    public $old = [];

    public function path()
    {
        return "/projects/{$this->id}";
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()       //set up eloquent relationship
    {
        return $this->hasMany(Task::class);
    }

    public function addTask($body)
    {
       return $this->tasks()->create(compact('body'));

//        Activity::create([
//            'project_id' => $this->id,
//            'description'=>'created_task'
//        ]);
//
//
//        return $this->tasks()->create(compact('body'));         //create new task where the body = input.
    }

    public function recordActivity($description)
    {
        $this->activity()->create([
            'description'=> $description,
            'changes' => [
                'before' => array_diff($this->old, $this->getAttributes()),
                'after'=> $this->getChanges()
            ]

        ]);

    }

    protected function activityChanges($description)
    {
        if ($description == 'updated') {
            return [
                'before' => array_except(array_diff($this->old, $this->getAttributes()), 'updated_at'),
                'after'=> array_except($this->getChanges(), 'updated_at')
            ];
        }
    }

    public function activity()
    {
        return $this->hasMany(Activity::class)->latest();
    }
}
