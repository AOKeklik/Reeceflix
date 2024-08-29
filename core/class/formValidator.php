<?php

class FormValidatior {
    private $errors = [];
    private $data = [];

    public function __construct($formData) {
        $this->data = $this->sanitizeFormData($formData);        
    }
    public function sanitizeFormData (array $formData) {
        $newFormData = [];
        foreach ($formData as $name => $value)
            $newFormData[$name] = htmlspecialchars((strip_tags(stripslashes(trim($value)))));

        return $newFormData;
    }
    public function required (string $field, string $msg) {
        $message = "<p class='register-lastname-error text-red-400 text-1.3 pt-05'>{$msg}</p>";

        if (empty($this->data[$field]))
            $this->errors[$field] = $message;

        return $this;
    }
    public function minmax (string $field, int $min=1, int $max=10) {
        $message = "<p class='register-lastname-error text-red-400 text-1.3 pt-05'>Please enter a value between {$min} and {$max} characters.</p>";

        if (strlen($this->data[$field]) < $min || strlen($this->data[$field]) > $max) 
            $this->errors[$field] = $message;

        return $this;
    }
    public function email (string $field) {
        $message = "<p class='register-lastname-error text-red-400 text-1.3 pt-05'>Invalid email address.</p>";

        if (!filter_var($this->data[$field], FILTER_VALIDATE_EMAIL))
            $this->errors[$field] = $message;    

        return $this;
    }
    public function confirm (string $field_1, string $field_2, string $msg) {
        $message = "<p class='register-lastname-error text-red-400 text-1.3 pt-05'>$msg</p>";

        if ($this->data[$field_1] !== $this->data[$field_2])
            $this->errors[$field_2] = $message;

        return $this;
    }


    public function getData () {
        return $this->data;
    }
    public function getErrors () {
        return $this->errors;
    }
    public function hasErrors ($filed=null) {
        if (is_null($filed))
            return !empty($this->errors);
        else
            return !empty($this->errors[$filed]);
    }
}