es (15 sloc)  293 Bytes
 

<?php

require_once('../app/core/controller.php');

class Logout extends Controller
{
    /**
     * load the User model and the logout method
    * @return void
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $user->logout();
    }
}