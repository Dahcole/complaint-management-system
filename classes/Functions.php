<?php
use Dotenv\Dotenv;

$dot_env = Dotenv::createImmutable(dirname(__DIR__));
$dot_env->load();

class Functions extends Database{
    private $msg;
    private $result;

    public function matricNo($username, $matric_no){
        //run sql
        $sql = "SELECT matric_no FROM user WHERE username = :username";
        $this->query($sql);
        //bind values
        $this->bind(':matric_no', $matric_no);
        $this->bind(':username', $username);
        //fetch data
        $this->result = $this->fetchColumn();
        //check if result fetching was successful
        if($this->result){
            return true;
        }else{
            return false;
        }
    }

    //password encryption
    public function Password_Encryption($password){
        $blowfish_hash_format = "$2y$12$00ok";
        $salt_length = 22;
        $salt = $this->generate_salt($salt_length);
        $formatting_blowfish_with_salt = $blowfish_hash_format.$salt;
        $hash = crypt($password, $formatting_blowfish_with_salt);
        return $hash;
    }

    //generate salt function
    public function generate_salt($length){
        $unique_random_string = md5(uniqid(mt_rand(), true));
        $base64_string = base64_encode($unique_random_string);
        $modified_base64_string = str_replace('+', '_', $base64_string);
        $salt = substr($modified_base64_string, 0, $length);
        return $salt;
    }
    //password check function//

    public function password_check($password, $existing_hash){
        $hash = crypt($password, $existing_hash);
        if($hash === $existing_hash){
            return true;
        }else{
            return false;
        }
    }

    //login check//
    public function loginCheck($matric_no, $password){
        global $matric_no;
        $sql = "SELECT * FROM user WHERE matric_no = '$matric_no'";
        $this->query($sql);
        $matric_no  = $this->fetchSingle();
        //check if matric no was found in database
        if($matric_no){
            global  $existing_hash;
            $existing_hash = $matric_no->password;//password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return $matric_no;
            }
        }else {
            return null;
        }
    }

    //login check admin
    public function loginCheckAdmin($username, $password){
        global $username;
        $sql = "SELECT * FROM admin WHERE username = '$username'";
        $this->query($sql);
        $username  = $this->fetchSingle();
        //check if username was found in database
        if($username){
            global  $existing_hash;
            $existing_hash = $username->password;//password already in database
            //check for password associated with same username
            if($this->password_check($password, $existing_hash)){
                return $username;
            }
        }else {
            return null;
        }
    }


    public function outPutmsg($msg){
        return $this->msg = $msg;
    }

    public function validate_phone($phone){
        $pattern = "/^[0]\d{10}$/";
        if(preg_match($pattern, $phone)){
            return true;
        }else{
            return false;
        }

    }

    /*
* slugify($text)
* Function to convert a text
* to slug (url-friendly version)
* @return slug string
*/
    public function slugify($text) {
        // covert to lowercase
        $word = strtolower($text);

        // remove excess whitespace
        $strippedWord = preg_replace('/\s\s+/', ' ', $word);

        // Replace strings
        $out = array(" ", "/", ".", "?", "(", ")", "$", "#", "&", "*", ",", "'", "\"", "“", "”", "\\", "+", "=", "%", "^");
        $slug = str_replace($out, "-", $strippedWord);

        // Remove cases of double "--"
        $newSlug = str_replace("--", "-", $slug);

        // Check if $out string is trailing at the end of the text
        if ( in_array(substr($newSlug, -1), $out) || substr($newSlug, -1) === "-") {
            $cleanedSlug = substr_replace($newSlug, "", -1);
        }
        else {
            $cleanedSlug = $newSlug;
        }

        return $cleanedSlug;
    }

    public function base_url(){

        return 'http://localhost:8080/project/';
    }



    //create function for password check

    public function Checkpassword($password){
        $password_pattern = preg_match("/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/", $password);
        //password
        /*
         * Password must include one uppercase letter, one lowercase letter, one number,
         * and one special character such as $ or %
         * and length should be between 6 and 16
         */
        if($password_pattern){
            return true;
        }else{
            return false;
        }
    }

    public  function short_text($text, $length){
        $maxTextLenght = $length;
        $aspace        = " ";
        if (strlen($text) > $maxTextLenght) {
            $text = substr(trim($text), 0, $maxTextLenght);
            $text = substr($text, 0, strlen($text) - strpos(strrev($text), $aspace));
            $text = $text . '...';
        }
        return $text;
    }

}
