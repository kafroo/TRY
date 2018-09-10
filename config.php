<?PHP
class Request
{
    public static function input($submit)
    {
        if (isset($_POST[$submit])) {           //return isset($_POST[$ey]) ? $_POST[$ey] : null; this is equavilent to this if condition

            return $_POST[$submit];
        } else {
            return null;
        }
    }
}

class Validation { 
    public static function isEmpty($first, $last, $email, $user, $pwd)
    {
        $inputValue = Request::input($first);
        $inputValue = Request::input($last);
        $inputValue = Request::input($email);
        $inputValue = Request::input($user);
        $inputValue = Request::input($pwd);

        return empty($inputValue);
    }
}

   /* THIS GIVES ME ERROR AS THE FUNCTIONS NAMES ARE REPEATED SO I TRIED THE ABOVE CODE
   public static function isEmpty($last)
    {
        $inputValue = Request::input($last);
        return empty($inputValue);
    }

    public static function isEmpty($pwd)
    {
        $inputValue = Request::input($pwd);
        return empty($inputValue);
    }

    public static function isEmpty($user)
    {
        $inputValue = Request::input($user);
        return empty($inputValue);
    }

    public static function isEmpty($email)
    {
        $inputValue = Request::input($email);
        return empty($inputValue);
    }
*/


/* $_POST['email'] = '';


if (isset($n)) {
    echo $n;
}

echo $_POST['email']; // undefined index 
*/