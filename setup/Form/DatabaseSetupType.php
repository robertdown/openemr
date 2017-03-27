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
            ->add('dbname', TextType::class, array('data' => 'openemr'))
            ->add('login', TextType::class, array('data' => 'openemr'))
            ->add('pass', PasswordType::class, array('data' => 'openemr'))
            ->add('rootuser', TextType::class, array('data' => 'openemr'))
            ->add('rootpass', PasswordType::class)
            ->add('loginhost', TextType::class, array('data' => 'localhost'))
            ->add('collate', ChoiceType::class)
            ->add('user', TextType::class, array('data' => 'user'))
            ->add('iuserpass', PasswordType::class)
            ->add('iufname', TextType::class)
            ->add('iuname', TextType::class)
            ->add('igroup', TextType::class)
            ->add('source', ChoiceType::class)
            ->add('clone_database', CheckboxType::class, array('required' => false))
            ->add('submit', SubmitType::class, array(
                'label' => 'Continue',
                'attr' => array(
                    'class' => 'btn btn-large',
                )
            ));
    }
}
