<?php
/**
 * This will run a SQL query to obtain columns from projects table
 *
 * @return array || returns a set array
 */
function get_project_list(){
    include 'connection.php';

    try {
        // return a result set array
        /** @var $db | PDOStatement object */
        return $db->query('SELECT project_id, title, category FROM projects');
    }catch(Exception $e){
        echo "Error: " . $e->getMessage() . "</br>";
        // return empty array if false
        return array();
    }
}

/**
 * This will run a SQL query to obtain all tasks and project title
 *
 * @param $filter || used to determine if filter value selected
 * @return array
 */
function get_task_list($filter = null){
    include 'connection.php';

    $sql = 'SELECT tasks.*, projects.title AS project FROM tasks'
        . ' JOIN projects ON tasks.project_id = projects.project_id';

    $where = '';

    // check if filter value selected from filter form
    if(is_array($filter)){
        switch($filter[0]){
            case 'project':
                $where = ' WHERE projects.project_id = ?';
                break;
            case 'category':
                $where = ' WHERE category = ?';
                break;
            case 'date':
                $where = ' WHERE date >= ? AND date <= ?';
                break;
        }
    }

    $orderBy = ' ORDER BY date DESC';

    // if a filter was used at all, then order by title and date
    if($filter){
        $orderBy = ' ORDER BY projects.title ASC, date DESC';
    }

    try {
        // return a result set array
        /** @var $db | PDOStatement object */
        $results = $db->prepare($sql . $where . $orderBy);
        if(is_array($filter)){
            $results->bindValue(1, $filter[1]);
            if($filter[0] == 'date'){
                $results->bindValue(2, $filter[2], PDO::PARAM_STR);
            }
        }
        $results->execute();
    } catch(Exception $e){
        echo "Error: " . $e->getMessage() . "</br>";
        // return empty array if false
        return array();
    }

    return $results->fetchAll(PDO::FETCH_ASSOC);
}

/**
 * This will get the project columns using a given project ID
 *
 * @param $project_id
 * @return bool || indicates that it was successfully entered
 */
function get_project($project_id){
    include 'connection.php';

    $sql = 'SELECT * FROM projects WHERE project_id = ?';

    try{
        /** @var $db || PDOStatement object */
        $results = $db->prepare($sql);
        $results->bindValue(1, $project_id, PDO::PARAM_INT);
        $results->execute();
    } catch(Exception $e){
        echo "ERROR: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetch();
}

/**
 * @param $task_id
 * @return bool
 */
function get_task($task_id){
    include 'connection.php';

    $sql = 'SELECT task_id, title, date, time, project_id FROM tasks WHERE task_id = ?';

    try{
        /** @var $db || PDOStatement object */
        $results = $db->prepare($sql);
        $results->bindValue(1, $task_id, PDO::PARAM_INT);
        $results->execute();
    } catch(Exception $e){
        echo "ERROR: " . $e->getMessage() . "<br />";
        return false;
    }
    return $results->fetch();
}

/**
 * This will insert 2 user-entered parameters into the database
 *
 * @param $title
 * @param $category
 * @return bool || indicates that it was successfully entered
 */
function add_project($title, $category, $project_id = null){
    include 'connection.php';

    if($project_id){
        $sql = 'UPDATE projects SET title = ?, category = ? WHERE project_id = ?';
    }else{
        $sql = 'INSERT INTO projects(title, category) VALUES (? , ?)';
    }

    try{
        /** @var $db || PDOStatement object */
        $results = $db->prepare($sql);
        $results->bindValue(1, $title, PDO::PARAM_STR);
        $results->bindValue(2, $category, PDO::PARAM_STR);
        if($project_id){
            $results->bindValue(3, $project_id, PDO::PARAM_INT);
        }
        $results->execute();
    } catch(Exception $e){
        echo "ERROR: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}

/**
 * This will run a SQL query to insert task data into the DB
 *
 * @param $project_id
 * @param $title
 * @param $date
 * @param $time
 * @param null $task_id || will be used to update tasks if option is selected
 * @return bool || indicates that task was added
 */
function add_task($project_id, $title, $date, $time, $task_id = null){
    include 'connection.php';

    if($task_id){
        $sql = 'UPDATE tasks SET project_id = ?, title = ?, date = ?, time = ?'
            . ' WHERE task_id = ?';
    }else{
        $sql = 'INSERT INTO tasks(project_id, title, date, time) VALUES(?, ?, ?, ?)';
    }

    try{
        /** @var $db | PDOStatement object */
        $results = $db->prepare($sql);
        $results->bindValue(1, $project_id, PDO::PARAM_STR);
        $results->bindValue(2, $title, PDO::PARAM_STR);
        $results->bindValue(3, $date, PDO::PARAM_STR);
        $results->bindValue(4, $time, PDO::PARAM_STR);
        if($task_id){
            $results->bindValue(5, $task_id, PDO::PARAM_INT);
        }
        $results->execute();
    } catch(Exception $e){
        echo "ERROR: " . $e->getMessage() . "<br />";
        return false;
    }
    return true;
}