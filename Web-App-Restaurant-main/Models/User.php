<?php

class User
{
    private $error = "";

    /**
     * signUp
     * @return void
     */
    public function signUp()
    {
        $db = Database::getInstance();

        $data = array();
        $data['F_Name'] = validateData($_POST['f-name']);
        $data['L_Name'] = validateData($_POST['l-name']);
        $data['Email'] = validateData($_POST['email']);
        $data['Passcode'] = $_POST['pass'];
        $password2 = $_POST['r-pass'];

        // check the datas 
        if (empty($data['F_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['F_Name'])) {
            $this->error .= "Veuillez entrez un nom valide. <br>";
        }

        if (empty($data['L_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['L_Name'])) {
            $this->error .= "Veuillez entrez un prénom valide. <br>";
        }

        if (empty($data['Email']) || (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Veuillez entrez un email valide. <br>";
        }

        if (strlen($data['Passcode']) < 6) {
            $this->error .= "Le mot de passe doit être long de 6 caractères au minimun. <br>";
        }

        if ($data['Passcode'] !== $password2) {
            $this->error .= "Les mots de passes ne correspondent pas. <br>";
        }

        $checkEmail = $this->checkEmail($data);

        if (is_array($checkEmail)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        if ($this->error == "") {
            $data['Passcode'] = hash('sha1', $data['Passcode']);

            $query = "INSERT INTO client (First_Name, Last_Name, Email, Pass)
            VALUES (:F_Name, :L_Name, :Email, :Passcode)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "login");
                die;
            }
        }
        $_SESSION['error'] = $this->error;
    }

    /**
     * login
     * @return void
     */
    public function login()
    {
        // $db = Database::newInstance();
        $db = Database::getInstance();
        $data = array();
        session_start();
        $data['Email'] = validateData($_POST['email']);
        $data['Passcode'] = validateData($_POST['pass']);

        if (empty($data['Email'])) {
            $this->error .= "Veuillez entrez un email valide. <br>";
        }

        if (empty($data['pass'])) {
            $this->error .= "Veuillez renseigner votre mot de passe. <br>";
        }

        if ($this->error == "") {
            $data['pass'] = hash('sha1', $data['pass']);

            $sql = "SELECT * FROM user WHERE Email = :Email && Pass = :Passcode limit 1";
            $result = $db->read($sql, $data);

            if (is_array($result)) {
                $_SESSION['idclient'] = $result[0]->Id_User;
                header("Location: " . "home");
                die;
            }
            $this->error .= "Email ou mot de passe incorrect. <br>";
        }
        $_SESSION['error'] = $this->error;
    }

    /**
     * checkLogin
     * @return object
     */
    public function checkLogin($allowed = array())
    {
        $db = Database::getInstance();

        if (count($allowed) > 0) {
            $arr['idclient'] = $_SESSION['idclient'];
            $query = "SELECT * FROM client  WHERE Id_User = :idclient limit 1";
            $result = $db->read($query, $arr);

            if (is_array($result)) {
                $result = $result[0];

                if ($result->Type === 'admin' && $allowed[0] === 'admin') {
                    return $result;
                } elseif ($allowed[1] === "customer") {
                    return $result;
                } else {
                    header("Location: " . "login");
                    die;
                }
            } else {
                header("Location: " . "login");
                die;
            }
        } else {
            if (isset($_SESSION['idclient'])) {
                $arr['idclient'] = $_SESSION['idclient'];
                $query = "SELECT * FROM client  WHERE Id_User = :idclient limit 1";
                $result = $db->read($query, $arr);
                if (is_array($result)) {
                    return $result[0];
                }
            }
        }
        return false;
    }

    /**
     * logout
     * @return void
     */
    public function logout()
    {
        if (isset($_SESSION['idclient'])) {         
            unset($_SESSION['idclient']);
            session_destroy();
        }

        header("Location: " . ROOT . "home");
    }

     /**
     * checkEmail
     * @return array
     */
    private function checkEmail($data)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM user WHERE Email = :Email limit 1";
        $arr['Email'] = $data['Email'];
        return $db->read($query, $arr);
    }

        //serach user
        function searchuser($nom,$prenom)
        {
            $db = Database::getInstance();
            $query = "SELECT * FROM client WHERE First_Name LIKE :nom AND Last_Name LIKE :prenom";
            $arr['nom'] = $nom;
            $arr['prenom'] = $prenom;
            return $db->read($query, $arr);
        }

    /**
     * updateUser
     * @return void
     */
    public function updateUser($idclient)
    {
        $db = Database::getInstance();

        $data = array();
        $data['F_Name'] = validateData($_POST['f-name']);
        $data['L_Name'] = validateData($_POST['l-name']);
        $data['Email'] = validateData($_POST['email']);
        $data['Passcode'] = $_POST['pass'];
        $password2 = $_POST['r-pass'];

        // check the datas 
        if (empty($data['F_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['F_Name'])) {
            $this->error .= "Veuillez entrez un nom valide. <br>";
        }

        if (empty($data['L_Name']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['L_Name'])) {
            $this->error .= "Veuillez entrez un prénom valide. <br>";
        }

        if (empty($data['Email']) || (!filter_var($data['Email'], FILTER_VALIDATE_EMAIL))) {
            $this->error .= "Veuillez entrez un email valide. <br>";
        }

        if (strlen($data['Passcode']) < 4) {
            $this->error .= "Le mot de passe doit être long de 4 caractères au minimun. <br>";
        }

        if ($data['Passcode'] !== $password2) {
            $this->error .= "Les mots de passes ne correspondent pas. <br>";
        }

        $checkEmail = $this->checkEmail($data);

        if (is_array($checkEmail)) {
            $this->error .= "L'email existe déjà, veuillez en renseigner un autre. <br>";
        }

        if ($this->error == "") {
            $data['Passcode'] = hash('sha1', $data['Passcode']);

            $query = "UPDATE client SET First_Name= :F_Name, Last_Name= :L_Name, Email= :Email, Pass= :Passcode WHERE Id_User = :idclient";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . ROOT . "profil");
                die;
            }
        }
        $_SESSION['error'] = $this->error;
    }

     /**
     * deleteUser
     * @return void
     */
    public function deleteUser($idclient)
    {
        $db = Database::getInstance();
        $db->write("DELETE FROM user WHERE Id_User = :idclient");
        header("Location: " . ROOT . "login");
    }

    
    //select all the users in the BD
    public function getAllUsers()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM user ORDER BY Id_User";
        $data = $db->read($query);
        return $data;
    }

    
     //makeTableUsers
    public function makeTableUsers($users)
    {
        $tableHTML = "";
        if (is_array($users)) {
            foreach ($users as $user) {
                $statut =  $muser->Type ? "Admin" : "Customer";
                $tableHTML .= '<tr>
                            <th scope="row">' . $user->Id_User . '</th>
                            <td>' . $statut . '</td>
                            <td>' . $user->First_Name . '</td>
                            <td>' . $user->Last_Name . '</td>
                            <td>' . $user->Email . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}