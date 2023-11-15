<?php

require_once('../app/core/controller.php');

class Command extends Controller
{
    /**
     * index
     * load the User model and load the reservation view
     * @return view home
     */
    public function index()
    {
        $user = $this->loadModel('User');
        $userData = $user->checkLogin();

        if (is_object($userData)) {
            $data['userData'] = $userData;
        }

        $reservation = $this->loadModel('Reservation');
        $idresrev = $reservation->ajoutReservation();
        $_SESSION['Id_Reservation'] = $idresrev;
        header("location:" . ROOT . "");
    }
}