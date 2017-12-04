<?php

namespace App;

/**
 * Description of Quote
 *
 * @author dinhtrong
 */
class Notification extends Entity{
    
    const ACTIVE = 1;
    const INACTIVE = 0;
    protected $table = 'content_notifications';
    protected $fillable = [
        'user_id',
        'poster_id',
        'resource_id',
        'resource_type',
        'status',
    ];

    protected $notification;

    public function scopeActive($query){
        return $query->where('status', self::ACTIVE_STATUS)->orderBy('name','ASC');
    }

    public static function courses(){
        $courses = Notification::where('resource_type','course')
                ->leftjoin('coach_courses','content_notifications.resource_id','=','coach_courses.id')
                ->select('coach_courses.title','coach_courses.course_id','coach_courses.slug','coach_courses.status as course_status','content_notifications.id as notification_id')
                ->get();
        return $courses;
    }

}
