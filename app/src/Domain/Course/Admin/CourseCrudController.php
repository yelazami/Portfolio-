<?php

declare(strict_types=1);

namespace App\Domain\Course\Admin;

use App\Domain\Course\Model\Course;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CourseCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Course::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Course')
            ->setEntityLabelInPlural('Course')
            ->setSearchFields(['name', 'description', 'id', 'type']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $places = AssociationField::new('places');
        $description = TextareaField::new('description');
        $beginDate = DateTimeField::new('beginDate');
        $endDate = DateTimeField::new('endDate');
        $id = Field::new('id', 'ID');
        $type = TextField::new('type');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $beginDate, $endDate, $id, $type, $places];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $description, $beginDate, $endDate, $id, $type, $places];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $places, $description, $beginDate, $endDate];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $places, $description, $beginDate, $endDate];
        }
    }
}
