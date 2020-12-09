<?php

declare(strict_types=1);

namespace App\Domain\Course\Admin;

use App\Domain\Course\Model\Place;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PlaceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Place::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Place')
            ->setEntityLabelInPlural('Place')
            ->setSearchFields(['name', 'coordinates', 'link', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $link = TextField::new('link');
        $coordinates = TextField::new('coordinates');
        $id = Field::new('id', 'ID');
        $courses = AssociationField::new('courses');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $coordinates, $link, $id, $courses];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $coordinates, $link, $id, $courses];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $link, $coordinates];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $link, $coordinates];
        }
    }
}
