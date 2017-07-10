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
    protected $imageManager;
    protected $filesBefore;

    public function __construct(\Zend\Db\Adapter\Adapter $dbAdapter, $imageManager) {
        $this->dbAdapter = $dbAdapter;
        $this->imageManager = $imageManager;

        $name = new Input('name');
        $name->setRequired(true);
        $name->setFilterChain($this->getStringTrimFilterChain());
        $name->setValidatorChain($this->getNameValidatorChain());

        $id_national = new Input('id_national');
        $id_national->setRequired(false);
        $id_national->setValidatorChain($this->getIdNationalValidatorChain());

        $description = new Input('description');
        $description->setRequired(true);
        $description->setFilterChain($this->getStringTrimFilterChain());
        $description->setValidatorChain($this->getDescriptionValidatorChain());


        $id_parent = new Input('id_parent');
        $id_parent->setRequired(false);
        $id_parent->setValidatorChain($this->getIdParentValidatorChain());

        $type_1 = new Input('type1');
        $type_1->setRequired(false);
        $type_1->setValidatorChain($this->getTypeValidatorChain());

        $type_2 = new Input('type2');
        $type_2->setRequired(false);
        $type_2->setValidatorChain($this->getTypeValidatorChain());

        $csrf = new Input('csrf');
        $csrf->setRequired(true);

        $id_poke = new Input('id_pokemon');
        $id_poke->setValidatorChain($this->getIdPokeValidatorChain());
        $id_poke->setRequired(true);

        $this->addImageValidator();
        $this->add($name);
        $this->add($id_poke);
        $this->add($id_national);
        $this->add($id_parent);
        $this->add($description);
        $this->add($type_1);
        $this->add($type_2);
        $this->add($csrf);
    }

    public function getRenamedFile() {
        $diff = array_diff($this->imageManager->getSavedFiles(), $this->filesBefore);
        return ((bool) count($diff)) ? $diff[0] : false;
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

    protected function getIdPokeValidatorChain() {
        $validator = new RecordExists([
            'table'   => 'pokemon',
            'field'   => 'id_pokemon',
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

    protected function getIdNationalValidatorChain() {
        $validator = new NoRecordExists([
            'table'   => 'pokemon',
            'field'   => 'id_national',
            'adapter' => $this->dbAdapter,
        ]);
        $valid = new GreaterThan([
            'min' => 1,
            'max' => 999,
            'inclusive' => true
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach($valid);
        $validatorChain->attach($validator);
        return $validatorChain;
    }

    protected function getIdParentValidatorChain() {
        $valid = new GreaterThan([
            'min' => 0,
            'inclusive' => true
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Digits());
        $validatorChain->attach($valid);
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

    protected function getTypeValidatorChain() {
        $valid = new GreaterThan([
            'min' => 0,
            'inclusive' => true
        ]);
        $validatorChain = new ValidatorChain();
        $validatorChain->attach(new Digits());
        $validatorChain->attach($valid);
        return $validatorChain;
    }

    protected function addImageValidator() {
        $this->filesBefore = $this->imageManager->getSavedFiles();
        $this->add([
            'type'     => 'Zend\InputFilter\FileInput',
            'name'     => 'image',
            'required' => false,
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
                        'target'=> $this->imageManager->getSaveToDir(),
                        'useUploadName'=>false,
                        'useUploadExtension'=>true,
                        'overwrite'=>true,
                        'randomize'=>true
                    ]
                ]
            ],
        ]);
    }

}
