<?php
namespace Pokemon\Form;


use Zend\Form\Form;
use Zend\Form\Element;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Entity\Hydrator\TypeHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Pokemon extends Form {

    public function __construct() {
        parent::__construct('pokemon');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PokemonHydrator());
        $hydrator->add(new TypeHydrator());
        $this->setHydrator($hydrator);

        $name = new Element\Text('poke_name');
        $name->setLabel('Name');
        $name->setAttribute('class','form-control');

        $national_id = new Element\Number('poke_id_national');
        $national_id->setLabel('Official id number');
        $national_id->setAttribute('class','form-control');
        $national_id->setAttribute('min',1);
        $national_id->setAttribute('max',151);

        $description = new Element\Text('poke_description');
        $description->setLabel('Description');
        $description->setAttribute('class','form-control');

        $img = new Element\Image('poke_image');
        $img->setLabel('Image');
        $img->setAttribute('class','form-control');

        $parent_id = new Element\Collection('poke_id_parent');
        $parent_id->setAllowAdd(true);
        $parent_id->setAllowRemove(true);
        $parent_id->setLabel('Parent');
        $parent_id->setAttribute('class','form-control');

        $type_1 = new Element\Collection('poke_type1');
        $type_1->setAllowAdd(true);
        $type_1->setAllowRemove(true);
        $type_1->setLabel('First type');
        $type_1->setAttribute('class','form-control');

        $type_2 = new Element\Collection('poke_type2');
        $type_2->setAllowAdd(true);
        $type_2->setAllowRemove(true);
        $type_2->setLabel('Second type');
        $type_2->setAttribute('class','form-control');

        $submit = new Element\Submit('submit');
        $submit->setValue('Send');
        $submit->setAttribute('class', 'btn btn-primary');

        $this->add($name);
        $this->add($national_id);
        $this->add($description);
        $this->add($img);
        $this->add($parent_id);
        $this->add($type_1);
        $this->add($type_2);
        $this->add($submit);
        $this->add([
            'type' => Element\Csrf::class,
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                   'timeout' => 180,
                ],
            ]
        ]);
    }
}
