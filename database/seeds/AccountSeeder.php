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
        $access_right = [];
        $access_right['superadmin'] = [
          'dashboard'   => [ 'r' => true ],
          'report'      => [ 'r' => true ],
          'group'       => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'user'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'cost'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'transaction' => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'item'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ]
        ];
        $access_right['owner'] = [
          'dashboard'   => [ 'r' => true ],
          'report'      => [ 'r' => true ],
          'group'       => [ 'c' => false, 'r' => false, 'u' => false, 'd' => false ],
          'user'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'cost'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'transaction' => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'item'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ]
        ];
        $access_right['cashier'] = [
          'dashboard'   => [ 'r' => false ],
          'report'      => [ 'r' => false ],
          'group'       => [ 'c' => false, 'r' => false, 'u' => false, 'd' => false ],
          'user'        => [ 'c' => false, 'r' => false, 'u' => false, 'd' => false ],
          'cost'        => [ 'c' => true, 'r' => true, 'u' => false, 'd' => false ],
          'transaction' => [ 'c' => true, 'r' => true, 'u' => true, 'd' => true ],
          'item'        => [ 'c' => true, 'r' => true, 'u' => true, 'd' => false ]
        ];

        Usergroup::create( [ 'name' => 'Administrator',   'access_right'  => json_encode( $access_right['superadmin'] ) ]);
        Usergroup::create( [ 'name' => 'Business Owner',  'access_right'  => json_encode( $access_right['owner'] ) ]);
        Usergroup::create( [ 'name' => 'Cashier',         'access_right'  => json_encode( $access_right['cashier'] ) ]);

        // Add default Admin username
        DB::table( 'users' )->delete();

        User::create( array(
          'group_id'     => 1,
          'email'        => 'admin@bash.com',
          'password'     => Hash::make( '123' ),
          'name'         => 'Super Admin',
          'avatar'       => Null,
          'coin'         => 0,
          'is_active'    => 'active',
          'created_at'   => new DateTime,
          'updated_at'   => new DateTime
        ));

        User::create( array(
          'group_id'     => 2,
          'email'        => 'owner@bash.com',
          'password'     => Hash::make( '123' ),
          'name'         => 'Pemilik Bisnis',
          'avatar'       => Null,
          'coin'         => 0,
          'is_active'    => 'active',
          'created_at'   => new DateTime,
          'updated_at'   => new DateTime
        ));

        User::create( array(
          'group_id'     => 3,
          'email'        => 'cashier@bash.com',
          'password'     => Hash::make( '123' ),
          'name'         => 'Cashier 1',
          'avatar'       => Null,
          'coin'         => 0,
          'is_active'    => 'active',
          'created_at'   => new DateTime,
          'updated_at'   => new DateTime
        ));
    }

}