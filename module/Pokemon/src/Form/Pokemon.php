<?php
namespace Pokemon\Form;


use Zend\Form\Form;
use Zend\Form\Element;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Entity\Hydrator\TypeHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Pokemon extends Form {

    public function __construct($pokemonService) {
        parent::__construct('pokemon');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PokemonHydrator());
        $hydrator->add(new TypeHydrator());
        $this->setHydrator($hydrator);

        $name = new Element\Text('name');
        $name->setLabel('Name');
        $name->setAttribute('class','form-control');

        $poke_id = new Element\Hidden('id_pokemon');

        $national_id = new Element\Number('id_national');
        $national_id->setLabel('Official id number');
        $national_id->setAttribute('class','form-control');
        $national_id->setAttribute('min',1);

        $description = new Element\Textarea('description');
        $description->setLabel('Description');
        $description->setAttribute('class','form-control');

        $img = new Element\File('image');
        $img->setLabel('Image');
        $img->setAttribute('class','form-control height-auto width-auto');
        $img->setAttribute('id','poke_image_input');

        $parent_id = new Element\Select('id_parent');
        $parent_id->setLabel('Parent');
        $parent_id->setAttribute('class','form-control');

        $options = [0 => null];
        foreach ( $pokemonService->getAll() as $possible_parent_pokemon ) {
            (int) $options[$possible_parent_pokemon->id_national] = $possible_parent_pokemon->name;
        }
        $parent_id->setValueOptions($options);

        $type_1 = new Element\Select('type1');
        $type_1->setLabel('First type');
        $type_1->setAttribute('class','form-control');

        $type_2 = new Element\Select('type2');
        $type_2->setLabel('Second type');
        $type_2->setAttribute('class','form-control');

        $submit = new Element\Submit('submit');
        $submit->setValue('Send');
        $submit->setAttribute('class', 'btn btn-primary btn-lg');

        $this->add($name);
        $this->add($poke_id);
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
