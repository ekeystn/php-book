<?php
include_once $_SERVER['DOCUMENT_ROOT'] . '/includes/magicquotes.inc.php';



if (isset($_GET['action']) and $_GET['action'] == 'search') {
    include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';

    //basic select statement
    $select = 'SELECT id, joketext';
    $from = 'FROM joke';
    $where = 'WHERE TRUE';

    $placeholders = array();

    if ($_GET['author'] != '') {// author selected
        $where .= " AND authorid = :authorid";
        $placeholders[':authorid'] = $_GET['author'];
    }

    if ($_GET['category'] != '') { //category selected
        $from .= ' INNER JOIN jokecategory ON id = jokeid';
        $where .= " AND categoryid = :categoryid";
        $placeholders[':categoryid'] = $_GET['category'];
    }

    if ($_GET['text'] != '') { //search text specified
        $where .= " And joketext LIKE :joketext";
        $placeholders[':joketext'] = '%' . $_GET['text'] . '%';
    }

    try {
        $sql = $select . $from . $where;
        $s = $pdo->prepare($sql);
        $s->execute($placeholders);
        
    }
    catch (PDOException $e) {
        $error = 'Error getting jokes';
        include 'error.html.php';
        exit();
    }

    foreach ($s as $row) {
        $jokes[] = array(
            'id' => $row['id'],
            'text' => $row['joketext']
        );
    }

    include 'jokes.html.php';
    exit();
}

//Display list of authors and categories
include $_SERVER['DOCUMENT_ROOT'] . '/includes/db.inc.php';
try{
    $result = $pdo->query('SELECT id, name FROM author');
}
catch(PDOException $e) {
    $error = 'Error getting authors from database';
    include 'error.html.php';
    exit();
}
foreach ($result as $row) {
    $authors[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}
try{
    $result = $pdo->query('SELECT id, name FROM category');
}
catch(PDOException $e) {
    $error = 'Error getting categories from database.';
    include 'error.html.php';
    exit();
}
foreach ($result as $row) {
    $categories[] = array(
        'id' => $row['id'],
        'name' => $row['name']
    );
}

include 'searchform.html.php';
?>
