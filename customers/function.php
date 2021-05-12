<?php

require_once('../response.php');
require_once('../connect.php');


class CRUD extends DB
{
    public function create($data = [])
    {
        $res = new Response;
        $sql = "INSERT INTO customers (CustomerName, ContactName,Address,City,PostalCode,Country) 
                VALUES (:CustomerName,:ContactName,:Address,:City,:PostalCode,:Country)";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':CustomerName', $data['CustomerName']);
            $stmt->bindParam(':ContactName', $data['ContactName']);
            $stmt->bindParam(':Address', $data['Address']);
            $stmt->bindParam(':City', $data['City']);
            $stmt->bindParam(':PostalCode', $data['PostalCode']);
            $stmt->bindParam(':Country', $data['Country']);
            $stmt->execute();
            $id = $this->conn->lastInsertID();
            $data['CustomerID'] = $id;
            $res->PUTsuccess($data);
        } catch (PDOException $e) {
            $res->error($e->getMessage());
        }
    }
    public function read($request = [])
    {
        $res = new Response;
        $where = "";
        if (isset($request['CustomerID'])) {
            $where .= "AND CustomerID = :id ";
        }
        if (isset($request['CustomerName'])) {
            $where .= "AND CustomerName = :CustomerName ";
        }
        if (isset($request['ContactName'])) {
            $where .= "AND ContactName = :ContactName ";
        }
        if (isset($request['Address'])) {
            $where .= "AND Address = :Address ";
        }
        if (isset($request['City'])) {
            $where .= "AND City = :City ";
        }
        if (isset($request['PostalCode'])) {
            $where .= "AND PostalCode = :PostalCode ";
        }
        if (isset($request['Country'])) {
            $where .= "AND Country = :Country ";
        }
        $sql = "SELECT * FROM customers WHERE CustomerID>0 {$where} ";
        try {
            $stmt = $this->conn->prepare($sql);
            if (isset($request)) {
                $stmt->execute($request);
            } else {
                $stmt->execute();
            }
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if (count($result) > 0) {
                $res->success($result, 200, 'success');
            } else {
                $res->error('not found', 404);
            }
        } catch (PDOException $e) {
            $res->error($e->getMessage(), 400);
        }
    }

    public function update($request)
    {
        $sql = "UPDATE customers SET  ";
        $set = "";
        $res = new Response;
        if ($request['CustomerName']) {
            $set .= "CustomerName = :CustomerName ";
        }
        if (isset($request['ContactName'])) {
            $set .= ", ContactName = :ContactName ";
        }
        if (isset($request['Address'])) {
            $set .= ", Address = :Address ";
        }
        if (isset($request['City'])) {
            $set .= ", City = :City ";
        }
        if (isset($request['PostalCode'])) {
            $set .= ", PostalCode = :PostalCode ";
        }
        if (isset($request['Country'])) {
            $set .= ", Country = :Country ";
        }

        $sql .= " {$set} WHERE CustomerID = :CustomerID";
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($request);

            $res->update();
        } catch (PDOException $e) {
            $res->error($e->getMessage());
        }
    }
    public function delete($request){
        $sql = "DELETE FROM customers WHERE CustomerID = :CustomerID";
        $res = new Response;
        try{
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($request);
            $res->delete();
        } catch (PDOException $e) {
            $res->error($e->getMessage());
        }
        
    }
}
