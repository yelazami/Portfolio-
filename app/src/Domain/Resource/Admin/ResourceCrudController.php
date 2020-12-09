<?php

declare(strict_types=1);

namespace App\Domain\Resource\Admin;

use App\Domain\Resource\Model\Resource;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ResourceCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Resource::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Resource')
            ->setEntityLabelInPlural('Resource')
            ->setSearchFields(['name', 'description', 'link', 'id']);
    }

    public function configureFields(string $pageName): iterable
    {
        $name = TextField::new('name');
        $type = AssociationField::new('type');
        $description = TextareaField::new('description');
        $link = TextField::new('link');
        $id = Field::new('id', 'ID');

        if (Crud::PAGE_INDEX === $pageName) {
            return [$name, $link, $id, $type];
        } elseif (Crud::PAGE_DETAIL === $pageName) {
            return [$name, $description, $link, $id, $type];
        } elseif (Crud::PAGE_NEW === $pageName) {
            return [$name, $type, $description, $link];
        } elseif (Crud::PAGE_EDIT === $pageName) {
            return [$name, $type, $description, $link];
        }
    }
}
