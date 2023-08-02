<?php

class Transaction_model
{
    private $table = 'transactions';
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Insert a new transaction into the database
    public function createTransactionWithPayment($data)
    {
        $query = "INSERT INTO transactions (buyer_id, seller_id, product_id, product_quantity, total_price, transaction_date)
                  VALUES (:buyer_id, :seller_id, :product_id, :product_quantity, :total_price, :transaction_date)";
        
        $this->db->query($query);
        $this->db->bind(':buyer_id', $data['buyer_id']);
        $this->db->bind(':seller_id', $data['seller_id']);
        $this->db->bind(':product_id', $data['product_id']);
        $this->db->bind(':product_quantity', $data['product_quantity']);
        $this->db->bind(':total_price', $data['total_price']);
        $this->db->bind(':transaction_date', $data['transaction_date']);
        $this->db->execute();

        // Get the last inserted transaction ID
        $transactionId = $this->db->lastInsertId();

        // Insert data into the Payment table
        $paymentQuery = "INSERT INTO payments (transaction_id, payment_method, payment_status, payment_date)
                         VALUES (:transaction_id, :payment_method, :payment_status, :payment_date)";
        
        $this->db->query($paymentQuery);
        $this->db->bind(':transaction_id', $transactionId);
        $this->db->bind(':payment_method', $data['payment_method']);
        $this->db->bind(':payment_status', $data['payment_status']);
        $this->db->bind(':payment_date', $data['transaction_date']);
        $this->db->execute();
        
        return $this->db->rowCount();
    }

    // Get all transactions from the database
    public function getAllTransactions()
    {
        $query = "SELECT * FROM $this->table";
        $this->db->query($query);
        return $this->db->resultSet();
    }

    // Get a transaction by ID
    public function getTransactionById($id)
    {
        $query = "SELECT * FROM $this->table WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->single();
    }

    // Update a transaction in the database
    public function updateTransaction($id, $buyerId, $sellerId, $productId, $productQuantity, $totalPrice, $transactionDate)
    {
        $query = "UPDATE $this->table SET 
                    buyer_id = :buyer_id,
                    seller_id = :seller_id,
                    product_id = :product_id,
                    product_quantity = :product_quantity,
                    total_price = :total_price,
                    transaction_date = :transaction_date
                WHERE id = :id";

        $this->db->query($query);
        $this->db->bind(':id', $id);
        $this->db->bind(':buyer_id', $buyerId);
        $this->db->bind(':seller_id', $sellerId);
        $this->db->bind(':product_id', $productId);
        $this->db->bind(':product_quantity', $productQuantity);
        $this->db->bind(':total_price', $totalPrice);
        $this->db->bind(':transaction_date', $transactionDate);

        return $this->db->execute();
    }

    // Delete a transaction from the database
    public function deleteTransaction($id)
    {
        $query = "DELETE FROM $this->table WHERE id = :id";
        $this->db->query($query);
        $this->db->bind(':id', $id);
        return $this->db->execute();
    }


}
