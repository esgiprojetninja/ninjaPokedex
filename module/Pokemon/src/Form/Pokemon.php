<?php
namespace Pokemon\Form;


use Zend\Form\Form;
use Zend\Form\Element;

use Pokemon\Entity\Hydrator\PokemonHydrator;
use Pokemon\Entity\Hydrator\TypeHydrator;
use Zend\Hydrator\Aggregate\AggregateHydrator;

class Pokemon extends Form {

    public function __construct($pokemonService, $typeService, $pokemon = null) {
        parent::__construct('pokemon');

        $hydrator = new AggregateHydrator();
        $hydrator->add(new PokemonHydrator());
        $hydrator->add(new TypeHydrator());
        $this->setHydrator($hydrator);

        $name = new Element\Text('name');
        $name->setLabel('Nom');
        $name->setAttribute('class','form-control');

        $poke_id = new Element\Hidden('id_pokemon');

        $national_id = new Element\Number('id_national');
        $national_id->setLabel('ID national');
        $national_id->setAttribute('class','form-control');
        $national_id->setAttribute('min',1);

        $description = new Element\Textarea('description');
        $description->setLabel('Description');
        $description->setAttribute('class','form-control');

        $img = new Element\File('image');
        $img->setLabel('Image');
        $img->setAttribute('class','form-control height-auto width-auto');
        $img->setAttribute('id','poke_image_input');

        if ( $pokemon != null ) {
            $parent_id = new Element\Select('id_parent');
            $parent_id->setLabel('Parent');
            $parent_id->setAttribute('class','form-control');

            $currentParentId = $pokemon->getIdParent();
            if ( $currentParentId != null ) {
              $currentParent = $pokemonService->findByIdNational(intval($currentParentId));
              $parent_options = [
                  (string)$currentParent['id_national'] => $currentParent['name'],
                  0 => 'Pas de parent'
              ];
            } else {
              $parent_options = [0 => 'Pas de parent'];
            }
            foreach ( $pokemonService->getAll() as $possible_parent_pokemon ) {
              if ( $pokemonService->canPokemonBeParentOf(intval($possible_parent_pokemon->id_national), intval($pokemon->getIdNational())) ) {
                (int) $parent_options[$possible_parent_pokemon->id_national] = $possible_parent_pokemon->name;

              }
            }
            $parent_id->setValueOptions($parent_options);
            $this->add($parent_id);
        }

        $type_1 = new Element\Select('type1');
        $type_1->setLabel('Premier type');
        $type_1->setAttribute('class','form-control');

        $type_2 = new Element\Select('type2');
        $type_2->setLabel('Second type');
        $type_2->setAttribute('class','form-control');

        $all_types = $typeService->getAllTypes();
        $type1_options = [];
        $type2_options = [];
        $type1_options['0'] = 'Pas de types';
        $type2_options['0'] = 'Pas de second type';
        foreach ($all_types as $type) {
            $type1_options[$type['id_type']] = $type['name_type'];
            $type2_options[$type['id_type']] = $type['name_type'];
        }
        // update case
        if ( $pokemon != NULL ) {
            $poke_types = $typeService->getPokemonTypes($pokemon->getIdPokemon());
            if ( $poke_types['type1'] != NULL ) {
                unset($type1_options[$poke_types['type1']['id_type']]);
                $type1_options = array($poke_types['type1']['id_type'] => $poke_types['type1']['name_type']) + $type1_options;
            }
            if ( $poke_types['type2'] != NULL ) {
                unset($type2_options[$poke_types['type2']['id_type']]);
                $type2_options = array($poke_types['type2']['id_type'] => $poke_types['type2']['name_type']) + $type2_options;
            }
        }
        $type_1->setValueOptions($type1_options);
        $type_2->setValueOptions($type2_options);

        $submit = new Element\Submit('submit');
        $submit->setValue('Valider');
        $submit->setAttribute('class', 'btn btn-primary btn-lg');

        $this->add($name);
        $this->add($poke_id);
        $this->add($national_id);
        $this->add($description);
        $this->add($img);
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
