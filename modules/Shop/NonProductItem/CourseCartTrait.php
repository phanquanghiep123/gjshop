<?php

namespace Modules\Shop\NonProductItem;

use App\Course;

/**
 * Description of NonProductCartTrait
 *
 * @author dinhtrong
 */
trait CourseCartTrait {
    
    protected $courses = [];
    
    public function getCourses(){
        return $this->courses;
    }

    public function addCourse(Course $course, $enrolmentId){
        if(isset($this->courses[$course->id])){
            throw new \Modules\Shop\Exceptions\ItemExist();
        }
        $this->courses[$course->id] = $course;
        $this->cartSession->update($this);
    }
    
    public function removeCourse($id) {
        if (key_exists($id, $this->courses)) {
            unset($this->courses[$id]);
        } else {
            throw new ItemNotAvailable();
        }
        $this->cartSession->update($this);
    }
    
    public function getTotalOfCourses(){
        $total = 0.00;
        foreach ($this->courses as $course){
            $total += $course->price; // need to update to the enrolment fee
        }
        return $total;
    }


    public function isEmptyCourse(){
        return empty($this->courses);
    }
    
    public function countCourses(){
        return count($this->courses);
    }
    
    public function isHaveCoursesOnly(){
        return empty($this->items) && !empty($this->courses);
    }
    
    public function isHaveCourses(){
        return !empty($this->courses);
    }
}
