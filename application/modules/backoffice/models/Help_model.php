<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Help_model extends CI_Model
{

    function checktonumber($value)
    {
        //SYARAT: pada form value harus set 1
        if ($value == "1") {
            return "1";
        } else {
            return "0";
        }
    }

    function numbertocheck($value)
    {
        if ($value == "1") {
            return "checked";
        } else {
            return "";
        }
    }
} //end model
