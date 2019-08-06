<?php

namespace Modules\Extranet\Repositories;

use Modules\Extranet\Entities\Element;
use Datatables;
use Prettus\Repository\Eloquent\BaseRepository;
use Lang;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Auth;
use Session;
use App\Extensions\VeosWsUrl;
use Config;


class ElementRepository extends BaseRepository
{
    public function __construct(BobyRepository $boby)
    {
        $this->boby = $boby;
        $this->client = new Client();
    }

    public function model()
    {
        return "Modules\\Extranet\\Entities\Element";
    }

    public function getElementsByType($element_type)
    {
        return Element::where('type',$element_type)->get();
    }

    /*
    *   Récupération models
    *   API : [POST] /boBy/list
    *
    *   @return Models List
    */
    public function getModelsByType($type)
    {
        $allBeans = $this->boby->postQuery(Element::TYPES[$type]['WS_NAME']);
        $beans = [];
        foreach ($allBeans as $bean) {
          if($bean->FORMAT == Element::TYPES[$type]['FORMAT']){
            $beans[]=$bean;
          }
        }
        return $beans;
    }

    /*
    *   Return fields from all field definition and filter by WS
    */
    public function getFieldsByElement($WS)
    {
        $beans = $this->boby->postQuery("WS_EXT2_DEF_CHAMPS");

        $fields = [];
        foreach($beans as $bean){
          if($bean->WS == $WS){
            $fields[] = $this->formatField($bean);
          }
        }

        return $fields;
    }

    private function mapFieldType($wsType)
    {

        $fields = Config('models.fields');

        $mapping = [];

        foreach($fields as $field){
          $mapping[$field['mapping']] = $field['identifier'];
        }

        return isset($mapping[$wsType]) ?
          $mapping[$wsType] : '';
    }

    private function mapIcons($wsType)
    {
        $fields = Config('models.fields');

        $icons = [];

        foreach($fields as $field){
          $icons[$field['mapping']] = $field['icon'];
        }

        return isset($icons[$wsType]) ?
          $icons[$wsType] : '';
    }

    private function getFieldType($parameters)
    {

        $fields = Config('models.fields');

        if(isset($parameters['format']) && $parameters['format'] != null && $parameters['format'] != ''){
          foreach($fields as $field){
            if($field['mapping'] == $parameters['format']){
                return $field;
            }
          }
        }

        return $fields['text'];
    }

    private function formatField($field)
    {
        $identifier = $field->REF;
        $definition = explode(",",$field->DEF);
        $parameters = [];
        foreach($definition as $parameter){
          $parameter = explode(":",$parameter);
          $parameters[trim($parameter[0])] = isset($parameter[1]) ?
            trim($parameter[1]) : '';
        }

        $fieldType = $this->getFieldType($parameters);

        return [
          'type' => $fieldType['identifier'],
          'identifier' => $identifier,
          'name' => isset($parameters['lib']) ? $parameters['lib'] : '',
          'icon' => $fieldType['icon'],
          'help' => isset($parameters['tooltip']) ? $parameters['tooltip'] : '',
          'default' => '',
          'boby' => '',
          'added' => false,
          'formats' => $fieldType['formats'],
          'rules' => $fieldType['rules'],
          'settings' => $fieldType['settings']
        ];

    }


    public function getModelValuesFromElement($element)
    {
        dd($element->model_exemple);
        return $this->boby->getModelValuesQuery($element->model_exemple);
    }

}
