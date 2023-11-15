<?php

class Staff
{
    private $error = "";

    /**
     * Ajout Staff
     * @return void
     */
    public function ajoutStaff()
    {
        $db = Database::getInstance();

        $data = array();
        $data['id_staff'] = validateData($_POST['id_staff']);
        $data['f_Name'] = validateData($_POST['name']);
        $data['email'] = validateData($_POST['email']);
        $data['phone_number'] = validateData($_POST['phone_Numb']);
        $data['salaire'] = validateData($_POST['sal']);
        $data['job'] = validateData($_POST['job']);


        // check the datas 

        if (empty($data['id_staff']) ) {
            $this->error .= "Please enter ID of the Staff. <br>";
        }

        if (empty($data['f_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['f_Name'])) {
            $this->error .= "Please enter a valid name. <br>";
        }

        if (empty($data['email']) || (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Please enter a valid email. <br>";
        }

        $checkEmail = $this->checkEmail($data);

        if (is_array($checkEmail)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        if (emty($data['phone_number']) || strlen($phoneNumber) !== 8 || !preg_match("/[^0-9]*$/", $data['phone_number'])) {
            $this->error .= " Please enter a valid phone number. <br>";
        }

        if (empty($data['salaire']) || $data['salaire'] < 600 ) {
            $this->error .= "Please enter a valid salaire. <br>";
        }

        if ($this->error == "") {
            $query = "INSERT INTO staff (Id_Staff, F_Name, 	Email, Phone_Number, Salaire, Job)
            VALUES (:id_staff, :f_Name, :email, :phone_number, :salaire, ;job)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "");
                die;
            }
        }
    }

     /**
     * checkEmail
     * @return array
     */
    private function checkEmail($data)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM staff WHERE Email = :Email limit 1";
        $arr['Email'] = $data['email'];
        return $db->read($query, $arr);
    }

     /**
     * update Staff
     * @return void
     */
    public function updateStaff($id_staff)
    {
        $db = Database::getInstance();

        $data = array();
        $data['id_staff'] = validateData($_POST['id_staff']);
        $data['f_Name'] = validateData($_POST['name']);
        $data['email'] = validateData($_POST['email']);
        $data['phone_number'] = validateData($_POST['phone_Numb']);
        $data['salaire'] = validateData($_POST['sal']);
        $data['job'] = validateData($_POST['job']);


        // check the datas 

        if (empty($data['id_staff']) ) {
            $this->error .= "Please enter ID of the Staff. <br>";
        }

        if (empty($data['f_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['f_Name'])) {
            $this->error .= "Please enter a valid name. <br>";
        }

        if (empty($data['email']) || (!filter_var($data['email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Please enter a valid email. <br>";
        }

        $checkEmail = $this->checkEmail($data);

        if (is_array($checkEmail)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        if (emty($data['phone_number']) || strlen($phoneNumber) !== 8 || !preg_match("/[^0-9]*$/", $data['phone_number'])) {
            $this->error .= " Please enter a valid phone number. <br>";
        }

        if (empty($data['salaire']) || $data['salaire'] < 600 ) {
            $this->error .= "Please enter a valid salaire. <br>";
        }

        if ($this->error == "") {
            $query = "UPDATE staff SET 	Id_Staff= :id_staff, F_Name= :f_Name, Email= :email, Phone_Number= phone_number, Salaire= :salaire Job= :job WHERE Id_Staff = :id_staff";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: "  . "");
                die;
            }
        }
    }

    /**
     * Delete Staff
     * @return void
     */
    public function deleteTable($id_staff)
    {
        $db = Database::getInstance();
        $db->write("DELETE FROM tables WHERE Id_Staff= :id_staff");
        header("Location: "  . "");
    }


    //search staff buy name and last name
    public function searchStaff($nom, $prenom)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM staff WHERE F_Name LIKE :nom AND L_Name LIKE :prenom";
        $arr['nom'] = $nom;
        $arr['prenom'] = $prenom;
        $data = $db->read($query, $arr);
        return $data;
    }
    
    //Select all the Staffs in the BD
    public function getAllTables()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM staff  ORDER BY Id_Staff";
        $data = $db->read($query);
        return $data;
    }

    //Make Table of Staffs
    public function makeTableStaffs($staffs)
    {
        $tableHTML = "";
        if (is_array($staffs)) {
            foreach ($staffs as $staff) {
                $tableHTML .= '<tr>
                            <th scope="row">' . $staff->Id_Staff . '</th>
                            <td>' . $staff->F_Name . '</td>
                            <td>' . $staff->Email . '</td>
                            <td>' . $staff->Phone_Number . '</td>
                            <td>' . $staff->Salaire . '</td>
                            <td>' . $staff->Job . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}