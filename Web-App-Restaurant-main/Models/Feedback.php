<?php

class Feedback
{
    private $error = "";

    /**
     * Ajout Feedback
     * @return void
     */
    public function ajoutPost()
    {
        $db = Database::getInstance();
        session_start();

        $data = array();
        $data['id_user']=$_SESSION['idclient'];
        $data['title'] = validateData($_POST['title']);
        $data['body'] = validateData($_POST['body']);
        

        // check the datas 

        if (empty($data['body'])) {
            $this->error .= "Please enter your feedback. <br>";
        }

        if (empty($data['title'])) {
            $this->error .= "Please enter a title. <br>";
        }

        if ($this->error == "") {
            $query = "INSERT INTO feedback (User_id, Title, Body, User_id)
            VALUES (:id_user, :title, :body)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "");
                die;
            }
        }
    }

     /**
     * Modification Feedback
     * @return void
     */
    public function modifposte($id_post)
    {
        $db = Database::getInstance();

        $data = array();
        $data['title'] = validateData($_POST['title']);
        $data['body'] = validateData($_POST['body']);
        

        // check the datas 

        if (empty($data['body'])) {
            $this->error .= "Please enter your feedback. <br>";
        }

        if (empty($data['title'])) {
            $this->error .= "Please enter a title. <br>";
        }


        if ($this->error == "") {
            $query = "UPDATE feedback SET Title= :title Body= :body WHERE Id_post = :id_post";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: "  . "");
                die;
            }
        }
    }

    /**
     * Delete Feedback
     * @return void
     */
    public function deletePost($id_post){
        $this->db->query('DELETE FROM feedback WHERE Id_post = :id_post');
        $this->db->bind(':id', $id);

        if($this->db->execute()){
            return true;
        }else{
            return false;
        }
    }
    
    //Select all the Feedback in the BD
    public function getAllFeedbak()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM feedback  ORDER BY Id_post ";
        $data = $db->read($query);
        return $data;
    }

    //Make table of Feedback
    public function makeTableFeedback($feedbacks)
    {
        $tableHTML = "";
        if (is_array($feedbacks)) {
            foreach ($feedbacks as $feedback) {
                $tableHTML .= '<tr>
                            <th scope="row">' . $feedback->Id_post . '</th>
                            <td>' . $feedback>User_id . '</td>
                            <td>' . $feedback->Title . '</td>
                            <td>' . $feedback->Body . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}

    
