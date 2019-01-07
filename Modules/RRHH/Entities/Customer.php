<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\RRHH\Traits\FormFieldsEntity;

use Illuminate\Database\Eloquent\Builder;
use DB;

class Customer extends Model
{
    use FormFieldsEntity;

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_UNACTIVE = 'UNACTIVE';

    protected $table = 'customers';

    public $fieldModel = 'Modules\RRHH\Entities\CustomerField';
    public $fieldKey = 'customer_id';

    protected $fillable = [
        'status'
    ];

    protected $appends = [
        'name'
    ];


    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => 'Active',
            self::STATUS_UNACTIVE => 'Inactive',
        ];
    }

    public function getStringStatus()
    {
        return isset($this->getStatus()[$this->status]) ? $this->getStatus()[$this->status] : null;
    }


    public function getNameAttribute()
    {
        return $this->getFieldValue('name');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\User', 'customers_users');
    }


    public function scopeOrderByField(Builder $query, $column, $mode, $iso = null)
    {
        if(in_array($column, $this->fillable) || $column == "id") {
            return $query->orderBy($column, $mode);
        }

        $columnName = $column . '_order';

        $sql = DB::raw(sprintf('(
            SELECT
                customers_fields.value
            FROM
                customers_fields
            WHERE
                customers_fields.customer_id = customers.id
            AND
                customers_fields.name = "%s"
            LIMIT 1
        ) AS %s', $column, $columnName));

        return $query
            ->select('*', $sql)
            ->orderBy($columnName, $mode);
    }

}
