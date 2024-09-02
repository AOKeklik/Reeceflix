<?php

class FormValidatior {
    private $pdo;
    private $errors = [];
    private $data = [];

    public function __construct($pdo) {
        $this->pdo = $pdo;        
    }

    public function formdata($formData) {
        $tempData = [];

        foreach ($formData as $name => $value)
            $tempData[$value] = $_POST[$value];

        $this->data = $this->sanitizeFormData($tempData); 
        
        return $this;
    }
    public function sanitizeFormData (array $formData) {
        $newFormData = [];
        foreach ($formData as $name => $value)
            $newFormData[$name] = htmlspecialchars((strip_tags(stripslashes(trim($value)))));

            
        return $newFormData;
    }
    public function required (string $field) {
        $message = $this->displayError (Constants::$MSG_REQUIRED);

        if (empty($this->data[$field]))
            $this->errors[$field][] = $message;

        return $this;
    }
    public function minmax (string $field, int $min=1, int $max=10) {
        $message = $this->displayError ("Please enter a value between {$min} and {$max} characters.</p>");

        if (strlen($this->data[$field]) < $min || strlen($this->data[$field]) > $max) 
            $this->errors[$field][] = $message;

        return $this;
    }
    public function email (string $field) {
        $message = $this->displayError (Constants::$MSG_VALID_EMAIL);

        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL))
            $this->errors[$field][] = $message;    

        return $this;
    }
    public function confirm (string $field_1, string $field_2, string $msg) {
        $message = $this->displayError ($msg);

        if ($this->data[$field_1] !== $this->data[$field_2])
            $this->errors[$field_2][] = $message;

        return $this;
    }
    public function isExist (string $table, string $field, string $msg) {
        try {
            if (!empty($this->data[$field])) {
                $message = $this->displayError ($msg);
                $sql = "select * from {$table} where {$field}=:{$field}";
                $stmt = $this->pdo->prepare($sql);
                $stmt->bindValue(":$field", $this->data[$field]);
                $stmt->execute();
                if ($stmt->rowCount() > 0)
                    $this->errors[$field][] = $message;
            }
            
            return $this;
        } catch (PDOException $err) {
            echo "IsExist : ".$err->getMessage();
        }
    }
    public function custom ($field, $msg) {
        $this->errors[$field][] = $this->displayError ($msg);

        return $this;
    }



    public function getData ($field=null) {
        if (is_null($field))
            return $this->data;
        else
            return isset($_POST[$field]) && isset($this->data[$field]) ? $this->data[$field] : "";
    }
    public function getErrors (string $field=null) {
        if (is_null($field))            
            return $this->errors;
        else   
            return !empty($this->errors) ? $this->errors[$field] : "";
    }
    public function clearData ($formData) {
        $tempData = [];

        foreach ($formData as $name => $value)
            $tempData[$value] = "";

        $this->data = $tempData;
    }
    public function hasErrors ($field=null) {
        if (is_null($field))
            return !empty($this->errors);
        else
            return !empty($this->errors[$field]);
    }
    public function displayError ($msg) {
        return "<p class='register-lastname-error text-red-400 text-1.3 pt-05'>".$msg."</p>";
    }
}