<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use App\sw_empleado;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class sw_usuario extends Model implements AuthenticatableContract, CanResetPasswordContract {

    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sw_usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */


    public $timestamps = false;

    protected $fillable = array ( 'usr_id','usr_emp_an8','usr_stu_id','usr_name','password','usr_caducidad','usr_flag_pass');

    protected $primaryKey = 'usr_id';





    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];


    public static function FilterAndPaginate ($name, $type)
    {
        return $users= sw_usuario::name($name)

            ->orderBy('usr_emp_an8','DESC')
            ->paginate();
    }
    public function profile()
    {
        return $this->hasOne('App\UserProfile');
    }

    public function getFullNameAttribute()
    {
        return $this->emp_nombre . ' ' . $this->emp_apellido;
    }



    public function setPasswordAttribute($value)
    {
       // $passnew ="urico";
        if(! empty ($value))
        {
            $this->attributes['password']= bcrypt($value);
        }

    }
//
//    public function scopeName($query, $name)
//    {
//
//        if(trim($name) != "")//si el nombre esta vacio muestreme toda la lista//omite espacios
//        {
//            $query->where(\DB::raw("emp"),"LIKE", "%$name%");//consulta Db::raw
//            //$query->where('full_name',"LIKE", "%$name%");
//        }
//
//    }

//    public function scopeType($query, $type)
//    {
//        $types = ['ful_name','emp_an8','emp_identificacion'];
//
//        if ($type != "" && isset ($types[$type])) {
//            $query->where('type', '=', $type);
//        }
//    }
//
//    public function is($type)
//    {
//        return $this->type === $type;
//    }

//    public function isAdmin()
//    {
//        return $this->type === 'admin';
//    }





}
