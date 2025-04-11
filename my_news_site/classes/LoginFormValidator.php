<?php
class LoginFormValidator extends FormValidator
{
    public function __construct($data = [], $files = [])
    {
        parent::__construct($data, $files);
    }

    public function validate()
    {

        // validate the form fields, placing any error messages in
        // $this->errors array

        // username
        if (!$this->isPresent("username")) {
            $this->errors['username'] = "You must enter a username";
        } else if (!$this->isMatch('username', '/^admin$/')) {
            $this->errors['username'] = "Username does not exist";
        }

        // password
        if (!$this->isPresent("password")) {
            $this->errors['password'] = "You must enter a password";
        } else if (!$this->isMatch('password', '/^admin$/')) {
            $this->errors['password'] = "Incorrect password";
        }

        return count($this->errors) === 0;
    }
}
?>