<?php 

namespace App\Traits;
use Hasob\FoundationCore\Models\User;

trait WithUser {
    /**
     * The instance of a user
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $user;

    /**
     * The instance of a userAuth
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $userAuth;

     /**
     * The instance of a admin
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $admin;

    /**
     * The instance of a adminAuth
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $adminAuth;

    /**
     * 
     */
    public function setUpUser(){
        $this->user = User::factory()->make();
    }   

    
}