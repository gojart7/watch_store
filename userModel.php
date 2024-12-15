<?php
class UserModel{
    private $id;
    private $name;
    private $surname;
    private $email;
    private $password;

    function __construct($id,$name,$surname,$email,$password){
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->password = $password;
        
      }

      function getId(){
        return $this->id;
    }
      function getName(){
          return $this->name;
      }
      function getsurname(){
        return $this->surname;
      }
      function getemail(){
        return $this->email;
      }
      function getPassword(){
        return $this->password;
      }


      function __toString(){
        return "User: ".$this->name." - ".$this->surname." - ".$this->email;
      }
}
?>