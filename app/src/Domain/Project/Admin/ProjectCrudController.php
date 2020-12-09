<?php

declare(strict_types=1);

namespace App\Domain\Project\Admin;

use App\Domain\Project\Model\Project;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProjectCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Project::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Project')
            ->setEntityLabelInPlural('Project')
            ->setSearchFields(['name', 'description', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $experiences = AssociationField::new('experiences');
        $description = TextareaField::new('description');
        $courses = AssociationField::new('courses');
        $id = Field::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $id, $experiences, $courses];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $description, $id, $experiences, $courses];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $experiences, $description, $courses];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $experiences, $description, $courses];
        }
    }
}
