<?php
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;
class UserTableSeeder extends Seeder {
/**
* Run the database seeds.
*
* @return void
*/
public function run()
{
$faker = Faker::create();
for($i = 0; $i < 1000; $i ++)
{

$id = \DB::table('users')->insertGetId(array(
'first_name'=>$faker->firstName,
'last_name'=>$faker->lastName,
'user_name'=>$faker->unique()->userName,
'email'=>$faker->unique()->email,
'password'=>\Hash::make('urico'),
'type'=> $faker->randomElement(['editor','contributor','subscriber','user']),
'remember_token'=> $faker->sha1,
'created_at' => new DateTime,
'updated_at' => new DateTime
// $this->call('UserTableSeeder');


));
\DB::table('user_profiles')->insert(array(
'user_id'=> $id,
'bio'=>$faker->paragraph(rand(2,5)),
'website'=>'http://www.'. $faker->domainName,
'twitter'=>'http://www.twitter.com/'. $faker->userName,
'birthdate'=>$faker->dateTimeBetween('-40 years', $endDate = '-18 years')->format('Y-m-d'),
'created_at' => new DateTime,
'updated_at' => new DateTime,
// $this->call('UserTableSeeder');
));
    $nombre=$faker->firstName;
    $apellido=$faker->lastName;
    $an8=$faker->unique()->numberBetween($min = 100000, $max = 999999);
     \DB::table('sw_empleados')->insert(array(
        'emp_an8'=>$an8,
        'emp_area_id'=>$faker->numberBetween($min = 1, $max = 10),
        'emp_cod_tm'=>'TM'.$faker->numberBetween($min = 1000, $max = 3000),
        'emp_identificacion'=>$faker->unique()->numberBetween($min = 100000, $max = 999999),
        'emp_nombre'=>$nombre,
        'emp_nombre2'=>$faker->firstName,
        'emp_apellido'=> $apellido,
        'emp_apellido2'=>$faker->lastName,
        'emp_direccion'=>$faker->address,
        'emp_telefono'=>$faker->phoneNumber,
        'emp_celular'=>$faker->phoneNumber,
        'emp_correo'=>$nombre.'.'.$apellido.'@masivocapital.co',
        'emp_fecha_nacimiento'=>$faker->dateTimeBetween('-50 years', $endDate = '-18 years')->format('Y-m-d'),
        'emp_unidad_negocio'=>$faker->swiftBicNumber,
        'emp_fecha_ingreso'=>$faker->dateTimeBetween('-4 years', $endDate = 'now')->format('Y-m-d'),
        'emp_fecha_salida'=>$faker->dateTimeBetween('-3 years', $endDate = 'now')->format('Y-m-d'),
        'emp_creado_en' => new DateTime,
        'emp_creado_por' => 'Swcapital',
        'emp_modificado_en' => new DateTime,
        'emp_modificado_por' => 'Swcapital'


// $this->call('UserTableSeeder');
    ));
    \DB::table('sw_usuarios')->insert(array(


        'usr_emp_an8'=>$an8,
        'usr_stu_id'=>$faker->numberBetween($min = 1, $max = 2),
        'usr_name'=>$nombre.'.'.$apellido,
        'password'=>\Hash::make('urico'),
        'usr_caducidad'=>$faker->randomElement($array = array ('10','20','30','40')),
        'usr_flag_pass'=>$faker->randomElement($array = array ('true','false')),
        'usr_creado_en' => new DateTime,
        'usr_creado_por' => 'Swcapital',
        'usr_modificado_en' => new DateTime,
        'usr_modificado_por' => 'Swcapital',
        'remember_token'=> $faker->sha1

// $this->call('UserTableSeeder');

    ));



}
}
}