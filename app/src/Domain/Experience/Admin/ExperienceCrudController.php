<?php

declare(strict_types=1);

namespace App\Domain\Experience\Admin;

use App\Domain\Experience\Model\Experience;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ExperienceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Experience::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Experience')
            ->setEntityLabelInPlural('Experience')
            ->setSearchFields(['name', 'level', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $type = AssociationField::new('type');
        $name = TextField::new('name');
        $level = TextField::new('level');
        $keyPoints = AssociationField::new('keyPoints');
        $projects = AssociationField::new('projects');
        $id = Field::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $level, $id, $type, $keyPoints, $projects];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $level, $id, $type, $keyPoints, $projects];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$type, $name, $level, $keyPoints, $projects];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$type, $name, $level, $keyPoints, $projects];
        }
    }
}
