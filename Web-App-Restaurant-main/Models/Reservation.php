<?php

class reservation
{
    private $error = "";

    /**
     * Ajout reservation
     * @return void
     */
    public function ajoutReservation()
    {
        $db = Database::getInstance();
        session_start();

        $data = array();
        $data['sex'] = validateData($_POST['sex']);
        $data['F_Name'] = validateData($_POST['f-name']);
        $data['L_Name'] = validateData($_POST['l-name']);
        $data['Email'] = validateData($_POST['email']);
        $data['phone_number'] = validateData($_POST["Phone_numb"]);
        $data['people_number'] = validateData($_POST['Ppl_numb']);
        $data['reservation_date'] = validateData($_POST['date']);
        $data['id_user']=$_SESSION['idclient'];

        // check the datas 
        if (empty($data['F_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['F_Name'])) {
            $this->error .= "Please enter a valid name. <br>";
        }

        if (empty($data['L_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['L_Name'])) {
            $this->error .= "Please enter a valid first name. <br>";
        }

        if (empty($data['Email']) || (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Please enter a valid email. <br>";
        }

        if (emty($data['phone_number']) || strlen($phoneNumber) !== 8 || !preg_match("/[^0-9]*$/", $data['phone_number'])) {
            $this->error .= " Please enter a valid phone number. <br>";
        }

        if (empty($data['Ppl_numb']) || $data['Ppl_numb'] < 1 || $data['Ppl_numb'] > 12) {
            $this->error .= "Please enter a valid number of people (1-12). <br>";
        }


        if (empty($data['reservation_date'] )|| (strtotime($data['reservation_date']) <= strtotime(date("m-d-Y")))) {
            $this->error .= "Veuillez entrer une date valide. <br>";
        }

        if ($this->error == "") {
            $query = "INSERT INTO reservation (Gender, First_Name, Last_Name, Email, Phone_Number, Number_People, Date_Reservation, User_ID)
            VALUES (:sex, :F_Name, :L_Name, :Email, :phone_number, :people_number, :reservation_date, :id_user)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "reussi");
                die;
            }
        }
    }

     /**
     * Modification Reservation
     * @return void
     */
    public function updateReservation($idresrev)
    {
        $db = Database::getInstance();
        $db = Database::getInstance();

        $data = array();
        $data['F_Name'] = validateData($_POST['f-name']);
        $data['L_Name'] = validateData($_POST['l-name']);
        $data['Email'] = validateData($_POST['email']);
        $data['phone_number'] = validateData($_POST["Phone_numb"]);
        $data['people_number'] = validateData($_POST['Ppl_numb']);
        $data['reservation_date'] = validateData($_POST['date']);

        // check the datas 
        if (empty($data['F_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['F_Name'])) {
            $this->error .= "Please enter a valid name. <br>";
        }

        if (empty($data['L_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['L_Name'])) {
            $this->error .= "Please enter a valid first name. <br>";
        }

        if (empty($data['Email']) || (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Please enter a valid email. <br>";
        }

        if (emty($data['phone_number']) || strlen($phoneNumber) !== 8 || !preg_match("/[^0-9]*$/", $data['phone_number'])) {
            $this->error .= " Please enter a valid phone number. <br>";
        }

        if (empty($data['people_number']) || $data['people_number'] < 1 || $data['people_number'] > 12) {
            $this->error .= "Please enter a valid number of people (1-12). <br>";
        }

        if (empty($data['reservation_date'] )|| (strtotime($data['reservation_date']) <= strtotime(date("m-d-Y")))) {
            $this->error .= "Veuillez entrer une date valide. <br>";
        }

        if ($this->error == "") {
            $query = "UPDATE reservation SET First_Name= :F_Name, Last_Name= :L_Name, Email= :Email, Phone_Number= phone_number, Number_People= people_number, Date_Reservationr= reservation_date  WHERE Id_Reservation = :idresrev";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: "  . "liste_reserv");
                die;
            }
        }
    }

    //search Reservation
    function searchreservation($id_resrvation){
        $db = Database::getInstance();
        $query = "SELECT * FROM reservation WHERE Id_Reservation = :id_resrvation";
        $data = $db->read($query, array("id_resrvation" => $id_resrvation));
        return $data;
    }

    /**
     * Delete Reservation
     * @return void
     */
    public function deleteReservation($idresrev)
    {
        $db = Database::getInstance();
        $db->write("DELETE FROM reservation WHERE Id_Reservation = :idresrev");
        header("Location: " . ROOT . "liste_reserv");
    }

    //select all the Reservations in the BD
    public function getAllReservation()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM reservation  ORDER BY Id_Reservation";
        $data = $db->read($query);
        return $data;
    }

    //Make Table Reservation
    public function makeTableReservation($Reservs)
    {
        $tableHTML = "";
        if (is_array($reservs)) {
            foreach ($reservs as $reserv) {
                $tableHTML .= '<tr>
                            <th scope="row">' . $reserv->Id_Reservation . '</th>
                            <td>' . $reserv->First_Name . '</td>
                            <td>' . $reserv->Last_Name . '</td>
                            <td>' . $reserv->Email . '</td>
                            <td>' . $reserv->Phone_Number . '</td>
                            <td>' . $reserv->Number_People . '</td>
                            <td>' . $reserv->Date_Reservation . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}