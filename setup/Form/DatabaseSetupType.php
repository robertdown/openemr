<?php
/**
 * Database Setup Form
 *
 * Abstracted form to setup the database
 *
 * Copyright (C) 2017 Robert Down <robertdown@live.com>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 *
 * @package     OpenEMR
 * @subpackage  Installation
 * @author      Robert Down <robertdown@live.com>
 * @license     GPL3
 * @copyright   2017 Robert Down <robertdown@live.com>
 * @link        http://www.open-emr.org
 *
 **/

namespace OpenEMR\Setup\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class DatabaseSetupType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('host', TextType::class, array('data' => 'localhost'))
            ->add('port', IntegerType::class, array('data' => '3306'))
            ->add('dbname', TextType::class, array('data' => 'openemr', 'label' => 'DB Name'))
            ->add('login', TextType::class, array('data' => 'openemr'))
            ->add('pass', PasswordType::class, array('data' => 'openemr'))
            ->add('rootuser', TextType::class, array('data' => 'openemr', 'label' => 'DB Root User'))
            ->add('rootpass', PasswordType::class, array('label' => 'DB Root Pass'))
            ->add('loginhost', TextType::class, array('data' => 'localhost', 'label' => 'Login Host'))
            ->add('collate', ChoiceType::class, array(
                'choices' => array(
                    'bin' => 'utf8_bin',
                    'czech' => 'utf8_czech_ci',
                    'danish' => 'utf8_danish_ci',
                    'esperanto' => 'utf8_esperanto_ci',
                    'estonian' => 'utf8_estonian_ci',
                    'general' => 'utf8_general_ci',
                    'icelandic' => 'utf8_icelandic_ci',
                    'latvian' => 'utf8_latvian_ci',
                    'lithuanian' => 'utf8_lithuanian_ci',
                    'persian' => 'utf8_persian_ci',
                    'polish' => 'utf8_polish_ci',
                    'roman' => 'utf8_roman_ci',
                    'romanian' => 'utf8_romanian_ci',
                    'slovak' => 'utf8_slovak_ci',
                    'slovenian' => 'utf8_slovenian_ci',
                    'spanish2 (traditional)' => 'utf8_spanish2_ci',
                    'spanish (modern)' => 'utf8_spanish_ci',
                    'swedish' => 'utf8_swedish_ci',
                    'turkish' => 'utf8_turkish_ci',
                    'unicode (german, french, russian, armeniam, greek)' => 'utf8_unicode_ci',
                    'none (do not force uft-8' => ''
                ),
                'data' => 'general',
                'label' => 'UTF-8 Collation')
            )
            ->add('user', TextType::class, array('data' => 'user', 'label' => 'Initial User'))
            ->add('iuserpass', PasswordType::class, array('label' => 'Initial User Password'))
            ->add('iufname', TextType::class, array('label' => 'Initial User First Name'))
            ->add('iuname', TextType::class, array('label' => 'Initial User Last Name'))
            ->add('igroup', TextType::class, array('label' => 'Initial Group'))
            ->add('source', ChoiceType::class)
            ->add('clone_database', CheckboxType::class, array(
                'required' => false,
                'label' => 'Clone the source site\'s database instead of creating a fresh one '))
            ->add('submit', SubmitType::class, array(
                'label' => 'Continue',
                'attr' => array(
                    'class' => 'btn btn-large',
                )
            ));
    }
}
