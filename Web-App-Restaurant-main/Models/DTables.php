<?php

class DTables
{
    private $error = "";

    /**
     * Ajout Table
     * @return void
     */
    public function ajoutTable()
    {
        $db = Database::getInstance();

        $data = array();
        $data['id_table'] = validateData($_POST['id_tab']);
        $data['capacity'] = validateData($_POST['capacity']);
        $data['emplacemnt'] = validateData($_POST['emplacemnt']);
        $data['statut'] = validateData($_POST['statut']);

        // check the datas 

        if (empty($data['id_table']) ) {
            $this->error .= "Please enter ID of the table. <br>";
        }

        if (empty($data['capacity']) || $data['capacity'] < 2 || $data['Ppl_numb'] > 13) {
            $this->error .= "Please enter a valid number of people (2-13). <br>";
        }

        if (empty($data['emplacement']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['emplacement'])) {
            $this->error .= "Please enter a valid place. <br>";
        }

        if ($this->error == "") {
            $query = "INSERT INTO tables (Id_Table, Capacity, Emplacement, Statut)
            VALUES (:id_table, :capacity, :emplacemnt, :statut)";

            $result = $db->write($query, $data);
            if ($result) {
                header("Location: " . "");
                die;
            }
        }
    }

     /**
     * Modification Table
     * @return void
     */
    public function modifTable($id_table)
    {
        $db = Database::getInstance();

        $data = array();
        $data['id_table'] = validateData($_POST['id_tab']);
        $data['capacity'] = validateData($_POST['capacity']);
        $data['emplacemnt'] = validateData($_POST['emplacemnt']);
        $data['statut'] = validateData($_POST['statut']);

        // check the datas 

        if (empty($data['id_table']) ) {
            $this->error .= "Please enter ID of the table. <br>";
        }

        if (empty($data['capacity']) || $data['capacity'] < 2 || $data['Ppl_numb'] > 13) {
            $this->error .= "Please enter a valid number of people (2-13). <br>";
        }

        if (empty($data['emplacement']) || !preg_match("/^[a-zA-Z-' ]*$/", $data['emplacement'])) {
            $this->error .= "Please enter a valid place. <br>";
        }

        if ($this->error == "") {
            $query = "UPDATE tables SET Id_Table= :id_table, Capacity= :capacity, Emplacement= :emplacemnt, Statut= statut  WHERE Id_Table = :idtable";
            $result = $db->write($query, $data);
            if ($result) {
                header("Location: "  . "");
                die;
            }
        }
    }

    /**
     * Delete Table
     * @return void
     */
    public function deleteTable($id_table)
    {
        $db = Database::getInstance();
        $db->write("DELETE FROM Tables WHERE Id_Table = :id_table");
        header("Location: "  . "");
    }

    //serach table
    public function searchTable($id_table)
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM Tables WHERE Id_Table = :id_table";
        $data = $db->read($query, array('id_table' => $id_table));
        return $data;
    }
    
    //Select all the Tables in the BD
    public function getAllTables()
    {
        $db = Database::getInstance();
        $query = "SELECT * FROM Tables  ORDER BY Id_Table";
        $data = $db->read($query);
        return $data;
    }

    //Make table of Tables
    public function makeTableTables($dtables)
    {
        $tableHTML = "";
        if (is_array($dtables)) {
            foreach ($dtables as $dtable) {
                $tableHTML .= '<tr>
                            <th scope="row">' . $dtable->Id_Table . '</th>
                            <td>' . $dtable>Capacity . '</td>
                            <td>' . $dtable->Emplacement . '</td>
                            <td>' . $dtable->Statut . '</td>
                        </tr>';
            }
        }
        return $tableHTML;
    }
}