<!-- Các hàm xử lý database -->
<?php
function query($sql, $data = [])
{
    global $conn;
    try {
        $insertStatus = false;
        $statement = $conn->prepare($sql);
        if (!empty($data)) {
            $insertStatus = $statement->execute($data);
        } else $insertStatus = $statement->execute();
    } catch (Exception $exception) {
        echo $exception->getMessage() . '<br>';
        echo 'File: ' . $exception->getFile() . '<br>';
        echo 'Line: ' . $exception->getLine() . '<br>';
        die();
    }
    return $insertStatus;
}
//ham insert
function insert($table, $data)
{
    $key = array_keys($data);
    $column = implode(',', $key);
    $value = ':' . implode(',:', $key);
    $sql = 'INSERT INTO ' . $table . '(' . $column . ')' . ' VALUES(' . $value . ')';
    $insertStatus = query($sql, $data);
    return $insertStatus;
}
//ham update
function update($table, $data, $condition)
{
    $update = '';
    foreach ($data as $key => $value) {
        $update = $update . $key . ' = :' . $key . ',';
    }
    $update = rtrim($update, ',');
    $sql = '';
    if (!empty($condition)) {
        $sql = $sql . 'UPDATE ' . $table . ' SET ' . $update . ' WHERE ' . $condition;
    } else {
        $sql = $sql . 'UPDATE ' . $table . ' SET ' . $update;
    }
    $updateStatus = query($sql, $data);
    return $updateStatus;
}

//ham delete
function delete($table, $condition)
{
    $sql = '';
    if (!empty($condition)) {
        $sql = $sql . 'DELETE FROM ' . $table . ' WHERE ' . $condition;
    } else
        $sql = $sql . 'DELETE FROM ' . $table;
    $updateStatus = query($sql);
    return $updateStatus;
}

//lay nhieu dong du lieu
function getRow($sql)
{
    global $conn;
    $statement = $conn->query($sql);
    return $statement->fetchAll(PDO::FETCH_ASSOC);
}

//lay mot dong du lieu
function oneRow($sql, $params)
{
    global $conn;
    $statement = $conn->prepare($sql);
    foreach ($params as $key => $value) {
        $statement->bindParam($key, $value);
    }
    $statement->execute();
    return $statement->fetch(PDO::FETCH_ASSOC);
}
//dem dong
function rowCount($sql)
{
    global $conn;
    $result = $conn->query($sql);
    return $result->rowCount();
}
