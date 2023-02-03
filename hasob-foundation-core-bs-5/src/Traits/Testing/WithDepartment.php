<?php
namespace Hasob\FoundationCore\Traits\Testing;

use Illuminate\Foundation\Testing\WithFaker;
use Hasob\FoundationCore\Models\Department;

/**
 * 
 */
trait WithDepartment
{
    /**
     * The instance of an department
     *
     * @var  \Hasob\FoundationCore\Models\Department;

     */

    protected $department;


    /**
     * Initialize the department instance.
     * 
     * @param  array|null  $department_data
     * @return void
     */
    public function setUpDepartment($department_data=null)
    {
        $this->department = $this->department($department_data);
    }
    

    /**
     * Get/creat an department instance for a given  data.
     *
     * @param  array|null  $department_data
     * @return \Hasob\FoundationCore\Models\Department;
     */
    public function department($department_data = null ){
        $department = is_array($department_data) ? 
                      Department::newFactory()->create($department_data) :
                      Department::firstOrCreate(Department::newFactory()->make()->toArray());
        return $department;
    }

    /**
     * Delete all of the model's associated database records
     * Reset any auto-incrementing IDs on the model's associated table
     * @return void
     */
    public function refreshDepartment():void{

        foreach (Department::withTrashed()->get() as $key => $department) {
            $department->forceDelete();
        }
       
    }
}
