<?php

declare(strict_types=1);

namespace App\Domain\Resource\Admin;

use App\Domain\Resource\Model\Type as ResourceType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResourceTypeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ResourceType::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setSearchFields(['name', 'description', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $description = TextareaField::new('description');
        $id = Field::new('id', 'ID');
        $resources = AssociationField::new('resources');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $id, $resources];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $description, $id, $resources];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $description];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $description];
        }
    }
}
