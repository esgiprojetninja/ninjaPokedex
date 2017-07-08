<?php
namespace Pokemon\InputFilter;
use Zend\InputFilter\InputFilter;
use Zend\InputFilter\Input;
use Zend\InputFilter\FileInput;
use Zend\Filter\FilterChain;
use Zend\Filter\StringTrim;
use Zend\Validator\StringLength;
use Zend\Validator\Digits;
use Zend\Validator\GreaterThan;
use Zend\Validator\ValidatorChain;
use Zend\Validator\File\IsImage as FileIsImage;
use Zend\Validator\File\ImageSize as FileImageSize;
use Zend\Validator\Regex;
use Zend\Validator\Csrf;
use Zend\I18n\Validator\Alnum;
use Zend\Validator\Db\RecordExists;
use Zend\Validator\Db\NoRecordExists;

class UpdatePokemonPost extends InputFilter {
    protected $dbAdapter;

    public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter) {
        $this->dbAdapter = $dbAdapter;

        $name = new Input('poke_name');
        $name->setRequired(true);
        $name->setFilterChain($this->getStringTrimFilterChain());
        $name->setValidatorChain($this->getNameValidatorChain());

        $id_national = new Input('poke_id_national');
        $id_national->setRequired(true);
        $id_national->setValidatorChain($this->getIdNationalValidatorChain());

        $description = new Input('poke_description');
        $description->setRequired(true);
        $description->setFilterChain($this->getStringTrimFilterChain());
        $description->setValidatorChain($this->getDescriptionValidatorChain());


        $id_parent = new Input('poke_id_parent');
        $id_parent->setRequired(false);
        $id_parent->setValidatorChain($this->getIdParentValidatorChain());

        $type_1 = new Input('poke_type1');
        $type_1->setRequired(false);
        $type_1->setValidatorChain($this->getTypeValidatorChain());

        $type_2 = new Input('poke_type2');
        $type_2->setRequired(false);
        $type_2->setValidatorChain($this->getTypeValidatorChain());

        $csrf = new Input('csrf');
        $csrf->setRequired(true);

        $this->addImageValidator();
        $this->add($name);
        $this->add($id_national);
        $this->add($id_parent);
        $this->add($description);
        $this->add($type_1);
        $this->add($type_2);
        $this->add($csrf);
    }

    protected function getStringTrimFilterChain() {
        $filterChain = new FilterChain();
        $filterChain->attach(new StringTrim());
        return $filterChain;
    }

    protected function getNameValidatorChain() {
        $stringLength = new StringLength();
        $stringLength->setMin(3);
        $stringLength->setMax(15);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Alnum(true));
        $validatorChain->attach($stringLength);
        return $validatorChain;
    }

    protected function getIdNationalValidatorChain() {
        $validator = new NoRecordExists([
            'table'   => 'pokemon',
            'field'   => 'id_national',
            'adapter' => $this->dbAdapter,
        ]);
        $valid = new GreaterThan([
            'min' => 1,
            'inclusive' => true,
            'max' => 151
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach($valid);
        $validatorChain->attach($validator);
        return $validatorChain;
    }

    protected function getIdParentValidatorChain() {
        $validator = new RecordExists([
            'table'   => 'pokemon',
            'field'   => 'id_national',
            'adapter' => $this->dbAdapter,
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach($validator);
        return $validatorChain;
    }

    protected function getDescriptionValidatorChain() {
        $stringLength = new StringLength();
        $stringLength->setMin(8);
        $stringLength->setMax(1000);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Regex(['pattern' => '/[A-z0-9\.,\s]/']));
        $validatorChain->attach($stringLength);
        return $validatorChain;
    }

    protected function addImageValidator() {
        $this->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'poke_image',
            'required' => true,
            'validators' => [
                ['name'    => 'FileUploadFile'],
                [
                    'name'    => 'FileMimeType',
                    'options' => [
                        'mimeType'  => ['image/jpeg', 'image/png', 'image/jpg', 'image/gif']
                    ]
                ],
                ['name'    => 'FileIsImage'],
                [
                    'name'    => 'FileImageSize',
                    'options' => [
                        'minWidth'  => 40,
                        'minHeight' => 40,
                        'maxWidth'  => 40,
                        'maxHeight' => 40
                    ]
                ],
            ],
            'filters'  => [
                [
                    'name' => 'FileRenameUpload',
                    'options' => [
                        'target'=>'./data/upload',
                        'useUploadName'=>true,
                        'useUploadExtension'=>true,
                        'overwrite'=>true,
                        'randomize'=>false
                    ]
                ]
            ],
        ]);
    }

    protected function getTypeValidatorChain() {
        $validator = new RecordExists([
            'table'   => 'type',
            'field'   => 'id_type',
            'adapter' => $this->dbAdapter,
        ]);
        $valid = new GreaterThan([
            'min' => 0,
            'inclusive' => true
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Digits());
        $validatorChain->attach($valid);
        $validatorChain->attach($validator);
        return $validatorChain;
    }

}
