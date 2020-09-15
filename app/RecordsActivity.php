<?php


namespace App;


trait RecordsActivity
{

    /**
     * The projects old attributes.
     *
     * @var array
     */
    public $oldAttributes = [];

    /**
     * Boot the trait.
     */
    public static function bootRecordsActivity()
    {

        foreach (self::recordableEvents() as $event) {
            static::$event(function ($model) use ($event) {

                $model->recordActivity($model->activityDescription($event));
            });

            if ($event === 'updated') {
                static::updating(function ($model) {
                    $model->oldAttributes = $model->getOriginal();
                });
            }
        }

    }

    protected function activityDescription($description)
    {
           return "{$description}_" . strtolower(class_basename($this));  //created_task

    }

    /**
     * @return array
     */
    protected static function recordableEvents(): array
    {
        if (isset(static::$recordableEvents)) {
            return static::$recordableEvents;
        }
            return ['created', 'updated'];
    }

    /**
     * Record activity for a project.
     *
     * @param string $description
     */

    public function recordActivity($description)
    {
        $this->activity()->create([
            //'user_id' => ($this->project ?? $this)->owner->id,
            'user_id' => auth()->user()->id,
            'description' => $description,
            'changes' => $this->activityChanges(),
            'project_id' => class_basename($this)==='Project' ? $this->id : $this->project_id
        ]);
    }


    public function activity()
    {
        return $this->morphMany(Activity::class, 'subject')->latest();
    }



    protected function activityChanges()
    {
        //var_dump($this->old, $this->toArray());
        if ($this->wasChanged()) {
            return [
                'before' => array_except(array_diff($this->oldAttributes, $this->getAttributes()), 'updated_at'),
                'after'=> array_except($this->getChanges(), 'updated_at')
            ];
        }
    }


}
