<?php

namespace Modules\RRHH\Entities;

use Illuminate\Database\Eloquent\Model;

use Modules\RRHH\Traits\FormFieldsEntity;

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

}
