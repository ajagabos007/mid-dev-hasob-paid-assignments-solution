<?php 

namespace Hasob\FoundationCore\Traits\Testing;
use Hasob\FoundationCore\Models\User;
use Laravel\Sanctum\Sanctum;
use Hash;

trait WithUser {
    /**
     * The instance of a user
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $user;

    /**
     * The instance of an autheticated user
     * @var Hasob\FoundationCore\Models\User;
     */
    protected $auth_user;

     /**
     * The instance of  an admin
     * @var Hasob\FoundationCore\Models\User $admin
     */
    protected $admin;

    /**
     * The instance of an authenticated admin 
     * @var Hasob\FoundationCore\Models\User; $user_auth
     */
    protected $auth_admin;

  /**
     * initialize the  user instance
     * 
     * @param array|null $user_data
     * @return void
     */
    public function setUpUser($user_data =null):void {
        $this->user = $this->user($user_data);
    }  
    
    /**
     * initialize the  admin instance
     * 
     * @param array|null $admin_data
     * @return void
     */
    public function setUpAdmin($admin_data =null):void {
        $this->admin = $this->admin($admin_data);
    }  


    /**
     *  create user and persisting user data to the database
     * 
     * @param array|null $user_data
     * @return  Hasob\FoundationCore\Models\User
    */
    public function user($user_data =null ) {
        $user = is_array($user_data) ? User::factory()->create($user_data) : User::where('email','<>', 'admin@app.com')->first();
        return $user ??   User::factory()->create();
    }   

    /**
     *  authentication a user 
     * 
     * @param Hasob\FoundationCore\Models\User|null $user
     * @return void
    */
    public function authUser( User $user=null):void {
        Sanctum::actingAs( $user ?? $this->user);
    }  

    /**
     *  create a new or retreive an existing admin 
     *  Persist admin datat to database if new admin created
     * 
     * @param array|null $admin_data
     * @return  Hasob\FoundationCore\Models\User
    */
    public function admin($admin_data =null ) {
        if(is_array($admin_data)){
            $admin_data['password']  = array_key_exists('password', $admin_data)? Hash::make($admin_data['password']): Hash::make('passsword');
            $admin = array_key_exists('email', $admin_data)? 
                    User::where('email',"=", $admin_data['email'])->firstOr( function() use($admin_data){
                        return User::factory()->create($admin_data);
                    })
                    : User::factory()->create($admin_data);     
         }else 
            $admin = User::where('email', 'admin@app.com')->firstOr(function(){
                return User::factory()->create(['email'=>'admin@app.com']);
            });

        return $admin;
    }   

    /**
     *  authentication an admin 
     * 
     * @param Hasob\FoundationCore\Models\User|null $admin
     * @return void
    */
    public function authAdmin( User $admin=null):void {
          Sanctum::actingAs( $admin ?? $this->admin);
    }  

    
}