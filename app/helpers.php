<?php
namespace App;

class Helpers
{
    public static function encryptId($id)
    {
        return encrypt($id);
    }

    public static function decryptId($encrypted)
    {
        return decrypt($encrypted);
    }

    // Keep your existing helpers like assignTeamAdminRoleIfDeleted
}
