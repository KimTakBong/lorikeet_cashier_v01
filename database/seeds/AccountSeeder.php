<?php
use App\Models\User;
use App\Models\Usergroup;
use Illuminate\Database\Seeder;

/**
 * AccountSeeder Models
 *
 * @author    Alfan Rlyanto ( alfan freeze@gmail.com )
 * @since     7/12/15
 * @category  Seeder
 * @version   1
 * @since     File available since Release 0.1
 * @copyright Copyright (c) 2015 Toruz.
 */
class AccountSeeder extends Seeder {

    public function run()
    {
        // Add Static Data Usergroup
        DB::table( 'usergroups' )->delete();

        $access_right = array();

        $access_right['administrator'] = array(
          'group'     => array(
            'c' => true,
            'r' => true,
            'u' => true,
            'd' => true
          ),
          'user'      => array(
            'c' => true,
            'r' => true,
            'u' => true,
            'd' => true
          ),
          'station'      => array(
            'c' => true,
            'r' => true,
            'u' => true,
            'd' => true
          )
        );
        Usergroup::create( array( 
          'name' => 'Administrator', 
          'access_right' => json_encode( $access_right['administrator'] ) 
        ));

        // Add default Admin username
        DB::table( 'users' )->delete();

        User::create( array(
          'group_id'     => 1,
          'email'        => 'alfan.freeze@gmail.com',
          'password'     => Hash::make( 'kentutbau12' ),
          'name'         => 'Alfan Rlyan',
          'avatar'       => Null,
          'coin'         => 0,
          'is_active'    => 'active',
          'created_at'   => new DateTime,
          'updated_at'   => new DateTime
        ));

        User::create( array(
          'group_id'     => 1,
          'email'        => 'admin@bash.com',
          'password'     => Hash::make( 'admin123rty' ),
          'name'         => 'Administrator',
          'avatar'       => Null,
          'coin'         => 0,
          'is_active'    => 'active',
          'created_at'   => new DateTime,
          'updated_at'   => new DateTime
        ));
    }

}